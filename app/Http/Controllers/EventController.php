<?php

namespace App\Http\Controllers;

use App\Exports\AttendeesExport;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index(): View
    {
        $events = Auth::user()->events()->latest()->get();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create(): View
    {
        return view('events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $event = Auth::user()->events()->create($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event): View
    {
        // Check if user owns the event
        $this->authorize('view', $event);

        $attendees = $event->attendees()->orderBy('name')->get();
        $checkedInCount = $event->getCheckedInCount();
        $totalCount = $event->getTotalAttendeesCount();

        return view('events.show', compact('event', 'attendees', 'checkedInCount', 'totalCount'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event): View
    {
        // Check if user owns the event
        $this->authorize('update', $event);

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Check if user owns the event
        $this->authorize('update', $event);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $event->update($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        // Check if user owns the event
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }

    /**
     * Display the QR code for the event.
     */
    public function showQrCode(Event $event): View
    {
        // Check if user owns the event
        $this->authorize('view', $event);

        return view('events.qr-code', compact('event'));
    }

    /**
     * Export attendees to Excel.
     */
    public function exportAttendees(Event $event)
    {
        // Check if user owns the event
        $this->authorize('view', $event);

        $organizerName = Auth::user()->name;
        $export = new AttendeesExport($event, $organizerName);
        return $export->download();
    }

    /**
     * Show the form for cloning an existing event.
     */
    public function showCloneForm(Event $event): View
    {
        // Check if user owns the event
        $this->authorize('view', $event);

        return view('events.clone', compact('event'));
    }

    /**
     * Clone the specified event and its attendees.
     */
    public function cloneEvent(Request $request, Event $event)
    {
        // Check if user owns the event
        $this->authorize('view', $event);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'clone_attendees' => 'sometimes|boolean',
        ]);

        // Create a new event
        $newEvent = $event->replicate(['qr_code_token']);
        $newEvent->name = $validated['name'];
        $newEvent->save();

        // Clone attendees if requested
        if ($request->has('clone_attendees') && $validated['clone_attendees']) {
            foreach ($event->attendees as $attendee) {
                $newAttendee = $attendee->replicate(['attendance_time']);
                $newAttendee->event_id = $newEvent->id;
                $newAttendee->attendance_time = null;
                $newAttendee->save();
            }
        }

        return redirect()->route('events.show', $newEvent)
            ->with('success', 'Event cloned successfully.');
    }
}
