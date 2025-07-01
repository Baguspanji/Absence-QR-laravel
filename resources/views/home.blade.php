<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Absence QR App</title>
        <meta name="description" content="A Laravel-based application for managing events and attendance tracking using QR codes">

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-white">
        <header class="bg-white dark:bg-zinc-800 shadow">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold">Absence QR App</h1>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md transition-all">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-zinc-600 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white transition-all">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md transition-all">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </header>

        <main>
            <!-- Hero Section -->
            <section class="py-16 bg-white dark:bg-zinc-800">
                <div class="container mx-auto px-4">
                    <div class="max-w-3xl mx-auto text-center">
                        <h1 class="text-4xl font-bold mb-6">Simplify Event Management & Attendance Tracking</h1>
                        <p class="text-xl text-zinc-600 dark:text-zinc-400 mb-8">A web-based solution to create events, generate QR codes, and track attendance in real-time</p>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white py-3 px-8 rounded-md text-lg transition-all">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white py-3 px-8 rounded-md text-lg transition-all">
                                Get Started
                            </a>
                        @endauth
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-16 bg-zinc-50 dark:bg-zinc-900">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-12">Key Features</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Event Management</h3>
                            <p class="text-zinc-600 dark:text-zinc-400">Create, edit, and delete events with all necessary details including name, description, location, and dates.</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2m0 0H8m4 0h4m-4-8v8m0 0l-4-4h8l-4 4z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">QR Code Generation</h3>
                            <p class="text-zinc-600 dark:text-zinc-400">Automatically generate unique QR codes for each event for easy attendance tracking.</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Attendance Tracking</h3>
                            <p class="text-zinc-600 dark:text-zinc-400">Scan QR codes to mark attendance with timestamps and track participants in real-time.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- How It Works Section -->
            <section class="py-16 bg-white dark:bg-zinc-800">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>

                    <div class="max-w-4xl mx-auto">
                        <div class="flex flex-col md:flex-row items-start gap-8 mb-12">
                            <div class="bg-green-100 dark:bg-green-900 rounded-full w-12 h-12 flex items-center justify-center shrink-0">
                                <span class="text-green-600 font-bold">1</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Create an Event</h3>
                                <p class="text-zinc-600 dark:text-zinc-400">Set up your event with all the necessary details like name, description, location, date, and time.</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-start gap-8 mb-12">
                            <div class="bg-green-100 dark:bg-green-900 rounded-full w-12 h-12 flex items-center justify-center shrink-0">
                                <span class="text-green-600 font-bold">2</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Generate QR Code</h3>
                                <p class="text-zinc-600 dark:text-zinc-400">The system automatically generates a unique QR code for your event that attendees can scan.</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-start gap-8">
                            <div class="bg-green-100 dark:bg-green-900 rounded-full w-12 h-12 flex items-center justify-center shrink-0">
                                <span class="text-green-600 font-bold">3</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2">Track Attendance</h3>
                                <p class="text-zinc-600 dark:text-zinc-400">Attendees scan the QR code upon arrival, and their attendance is automatically recorded with timestamps.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-16 bg-green-600">
                <div class="container mx-auto px-4 text-center">
                    <h2 class="text-3xl font-bold text-white mb-6">Ready to Simplify Your Event Management?</h2>
                    <p class="text-xl text-white opacity-90 mb-8 max-w-2xl mx-auto">Start creating events, generating QR codes, and tracking attendance with our easy-to-use platform.</p>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center bg-white text-green-600 hover:bg-zinc-100 py-3 px-8 rounded-md text-lg font-medium transition-all">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-white text-green-600 hover:bg-zinc-100 py-3 px-8 rounded-md text-lg font-medium transition-all">
                            Sign Up Now
                        </a>
                    @endauth
                </div>
            </section>
        </main>

        <footer class="bg-zinc-900 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Absence QR App</h3>
                        <p class="text-zinc-400">A Laravel-based application for managing events and attendance tracking using QR codes.</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4">Tech Stack</h3>
                        <ul class="space-y-2 text-zinc-400">
                            <li>Laravel 12.x</li>
                            <li>Livewire and Volt</li>
                            <li>TailwindCSS 4.x</li>
                            <li>QR Code Generator</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4">Get Started</h3>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md transition-all">
                                Dashboard
                            </a>
                        @else
                            <div class="space-y-2">
                                <div>
                                    <a href="{{ route('login') }}" class="text-zinc-400 hover:text-white transition-all">
                                        Log In
                                    </a>
                                </div>
                                @if (Route::has('register'))
                                    <div>
                                        <a href="{{ route('register') }}" class="text-zinc-400 hover:text-white transition-all">
                                            Register
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="border-t border-zinc-800 mt-12 pt-8 text-center text-zinc-500">
                    <p>© {{ date('Y') }} Absence QR App. All rights reserved.</p>
                    <p class="mt-2">Built with Laravel | QR code generation by SimpleSoftwareIO</p>
                </div>
            </div>
        </footer>
    </body>
</html>
