<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendeeController extends Controller
{
    /**
     * Show the form for creating a new attendee.
     */
    public function create(Event $event): View
    {
        $this->authorize('update', $event);

        return view('attendees.create', compact('event'));
    }

    /**
     * Store a newly created attendee in storage.
     */
    public function store(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $event->attendees()->create($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Attendee added successfully.');
    }
    /**
     * Import multiple attendees from CSV/Excel file.
     */
    public function import(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xls,xlsx',
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        // Simple CSV import implementation
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Skip the header row
            $header = fgetcsv($handle);

            $importCount = 0;

            // Process each row
            while (($data = fgetcsv($handle)) !== false) {
                // Map CSV columns to attendee fields
                // Assuming CSV has columns: name, email, phone (in that order)
                // Adjust mapping according to your actual CSV structure
                $name = $data[0] ?? null;
                $email = $data[1] ?? null;
                $phone = $data[2] ?? null;

                if ($name) {
                    $event->attendees()->create([
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                    ]);

                    $importCount++;
                }
            }

            fclose($handle);

            return redirect()->route('events.show', $event)
                ->with('success', $importCount . ' ' . __('attendees imported successfully.'));
        }

        return redirect()->route('events.show', $event)
            ->with('error', __('Failed to process the import file.'));
    }

    /**
     * Remove the specified attendee from storage.
     */
    public function destroy(Event $event, Attendee $attendee)
    {
        $this->authorize('update', $event);

        $attendee->delete();

        return redirect()->route('events.show', $event)
            ->with('success', 'Attendee removed successfully.');
    }
}
