<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
            'school' => 'nullable|string|max:255',
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
        $extension = $file->getClientOriginalExtension();

        $importCount = 0;
        $errorRows = [];

        try {
            // Handle CSV files
            if (in_array($extension, ['csv', 'txt'])) {
                if (($handle = fopen($filePath, 'r')) !== false) {
                    // Skip the header row
                    $header = fgetcsv($handle);

                    $rowNumber = 1; // Start from row 1 (after header)

                    // Process each row
                    while (($data = fgetcsv($handle)) !== false) {
                        $rowNumber++;

                        // Map CSV columns to attendee fields
                        $name = $data[0] ?? null;
                        $school = $data[1] ?? null;
                        $phone = $data[2] ?? null;

                        if (!empty($name)) {
                            try {
                                $event->attendees()->create([
                                    'name' => $name,
                                    'school' => $school,
                                    'phone' => $phone,
                                ]);

                                $importCount++;
                            } catch (\Exception $e) {
                                $errorRows[] = "Row {$rowNumber}: {$e->getMessage()}";
                            }
                        }
                    }

                    fclose($handle);
                }
            }
            // Handle Excel files (XLS, XLSX)
            else if (in_array($extension, ['xls', 'xlsx'])) {
                // Read the Excel file
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                // Skip header row
                $header = array_shift($rows);

                $rowNumber = 1; // Start from row 1 (after header)

                foreach ($rows as $row) {
                    $rowNumber++;

                    $name = $row[0] ?? null;
                    $school = $row[1] ?? null;
                    $phone = $row[2] ?? null;

                    if (!empty($name)) {
                        try {
                            $event->attendees()->create([
                                'name' => $name,
                                'school' => $school,
                                'phone' => $phone,
                            ]);

                            $importCount++;
                        } catch (\Exception $e) {
                            $errorRows[] = "Row {$rowNumber}: {$e->getMessage()}";
                        }
                    }
                }
            }

            if ($importCount > 0) {
                $message = $importCount . ' ' . __('attendees imported successfully.');

                if (!empty($errorRows)) {
                    $message .= ' ' . count($errorRows) . ' rows had errors.';
                }

                return redirect()->route('events.show', $event)->with('success', $message);
            } else if (!empty($errorRows)) {
                return redirect()->route('events.show', $event)
                    ->with('error', __('No attendees were imported. Please check your file format.'));
            }

        } catch (\Exception $e) {
            return redirect()->route('events.show', $event)
                ->with('error', __('Error processing file: ') . $e->getMessage());
        }

        return redirect()->route('events.show', $event)
            ->with('error', __('Failed to process the import file.'));
    }

    /**
     * Download a template for attendee import.
     */
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="attendees_import_template.csv"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            // Add header row
            fputcsv($file, ['name', 'school', 'phone']);

            // Add example row
            fputcsv($file, ['John Doe', 'University of Example', '123456789']);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
