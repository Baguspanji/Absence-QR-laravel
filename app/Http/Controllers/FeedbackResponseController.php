<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\FeedbackResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackResponseController extends Controller
{
    /**
     * Show the feedback form for public access.
     */
    public function show($token): View
    {
        $feedback = Feedback::where('qr_code_token', $token)
            ->where('is_active', true)
            ->firstOrFail();

        return view('feedback.public-form', compact('feedback'));
    }

    /**
     * Store a new feedback response.
     */
    public function store(Request $request, $token)
    {
        $feedback = Feedback::where('qr_code_token', $token)
            ->where('is_active', true)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'feedback' => 'required|string|max:2000',
        ]);

        $validated['feedback_id'] = $feedback->id;
        $validated['submitted_at'] = now();

        FeedbackResponse::create($validated);

        return view('feedback.thank-you', compact('feedback'))
            ->with('success', 'Thank you for your feedback!');
    }
}
