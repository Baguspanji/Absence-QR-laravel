<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    /**
     * Show the attendance page for a specific event.
     */
    public function show(string $token): View
    {
        $event = Event::where('qr_code_token', $token)->firstOrFail();
        $pendingAttendees = $event->attendees()
            ->whereNull('attendance_time')
            ->orderBy('name')
            ->get();

        return view('attendance.show', compact('event', 'pendingAttendees'));
    }

    /**
     * Mark an attendee as present.
     */
    public function markPresent(Request $request, string $token)
    {
        $event = Event::where('qr_code_token', $token)->firstOrFail();
        $attendeeId = $request->validate(['attendee_id' => 'required|exists:attendees,id'])['attendee_id'];

        $attendee = $event->attendees()->findOrFail($attendeeId);

        if ($attendee->hasCheckedIn()) {
            return redirect()->route('attendance.show', $token)
                ->with('error', 'Attendee has already checked in.');
        }

        $attendee->update(['attendance_time' => now()]);

        return redirect()->route('attendance.confirmation', [
            'token' => $token,
            'attendee' => $attendee->id
        ]);
    }

    /**
     * Show confirmation page after successful attendance.
     */
    public function confirmation(string $token, Attendee $attendee): View
    {
        $event = Event::where('qr_code_token', $token)->firstOrFail();

        if ($attendee->event_id !== $event->id) {
            abort(404);
        }

        return view('attendance.confirmation', compact('event', 'attendee'));
    }
}
