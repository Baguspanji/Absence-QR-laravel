<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function index(): View
    {
        $events = Event::where('user_id', Auth::id())->latest()->take(5)->get();
        $feedbacks = Feedback::where('user_id', Auth::id())->latest()->take(5)->get();

        return view('dashboard', compact('events', 'feedbacks'));
    }
}
