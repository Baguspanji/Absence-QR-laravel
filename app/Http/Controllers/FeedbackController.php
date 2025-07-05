<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedback.
     */
    public function index(): View
    {
        $feedbacks = Feedback::where('user_id', Auth::id())->latest()->get();

        return view('feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new feedback.
     */
    public function create(): View
    {
        return view('feedback.create');
    }

    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $feedback = Feedback::create($validated);

        return redirect()->route('feedback.show', $feedback)
            ->with('success', 'Feedback created successfully.');
    }

    /**
     * Display the specified feedback.
     */
    public function show(Feedback $feedback): View
    {
        // Check if user owns the feedback
        $this->authorize('view', $feedback);

        $responses = $feedback->responses()->orderBy('submitted_at', 'desc')->get();
        $totalResponses = $feedback->getTotalResponsesCount();

        return view('feedback.show', compact('feedback', 'responses', 'totalResponses'));
    }

    /**
     * Show the form for editing the specified feedback.
     */
    public function edit(Feedback $feedback): View
    {
        // Check if user owns the feedback
        $this->authorize('update', $feedback);

        return view('feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified feedback in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        // Check if user owns the feedback
        $this->authorize('update', $feedback);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
        ]);

        $feedback->update($validated);

        return redirect()->route('feedback.show', $feedback)
            ->with('success', 'Feedback updated successfully.');
    }

    /**
     * Remove the specified feedback from storage.
     */
    public function destroy(Feedback $feedback)
    {
        // Check if user owns the feedback
        $this->authorize('delete', $feedback);

        $feedback->delete();

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }

    /**
     * Display the QR code for the feedback.
     */
    public function showQrCode(Feedback $feedback): View
    {
        // Check if user owns the feedback
        $this->authorize('view', $feedback);

        return view('feedback.qr-code', compact('feedback'));
    }

    /**
     * Toggle the active status of the feedback.
     */
    public function toggleActive(Feedback $feedback)
    {
        // Check if user owns the feedback
        $this->authorize('update', $feedback);

        $feedback->update(['is_active' => !$feedback->is_active]);

        return redirect()->route('feedback.show', $feedback)
            ->with('success', 'Feedback status updated successfully.');
    }
}
