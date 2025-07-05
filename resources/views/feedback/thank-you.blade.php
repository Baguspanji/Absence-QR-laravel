<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Terima Kasih') }} - {{ $feedback->title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        .bounce-in {
            animation: bounceIn 0.8s ease-out;
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-checkmark {
            animation: checkmark 0.6s ease-in-out 0.2s both;
        }

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 100;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center">
        <!-- Success Icon -->
        <div class="bounce-in mb-6">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path class="success-checkmark" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                        d="M5 13l4 4L19 7" stroke-dasharray="100" stroke-dashoffset="100"></path>
                </svg>
            </div>
        </div>

        <!-- Thank You Card -->
        <div class="glass-effect rounded-3xl p-8 text-white fade-in-up">
            <h1 class="text-3xl font-bold mb-4">{{ __('Terima Kasih!') }}</h1>
            <p class="text-white/90 text-lg mb-6">
                {{ __('Feedback Anda telah berhasil dikirim untuk:') }}
            </p>
            <h2 class="text-xl font-semibold mb-6 text-white/95">{{ $feedback->title }}</h2>

            <div class="bg-white/10 rounded-2xl p-4 mb-6">
                <p class="text-white/80 text-sm">
                    {{ __('Masukan Anda sangat berharga bagi kami. Terima kasih telah meluangkan waktu untuk memberikan feedback.') }}
                </p>
            </div>

            <!-- Additional Actions -->
            <div class="space-y-3">
                <button onclick="window.close()"
                    class="w-full bg-white/20 hover:bg-white/30 text-white font-semibold py-3 rounded-xl transition-all duration-200">
                    {{ __('Tutup Halaman') }}
                </button>

                <button onclick="location.reload()"
                    class="w-full bg-white/10 hover:bg-white/20 text-white font-semibold py-3 rounded-xl transition-all duration-200">
                    {{ __('Kirim Feedback Lain') }}
                </button>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 fade-in-up">
            <p class="text-white/60 text-sm">
                {{ __('Powered by QR Feedback System') }}
            </p>
        </div>
    </div>

    <script>
        // Auto redirect after 10 seconds (optional)
        setTimeout(function() {
            const redirectNotice = document.createElement('div');
            redirectNotice.className = 'fixed bottom-4 right-4 bg-white/20 text-white p-3 rounded-lg text-sm';
            redirectNotice.innerHTML = '{{ __("Halaman akan tertutup dalam 5 detik...") }}';
            document.body.appendChild(redirectNotice);

            setTimeout(function() {
                window.close();
            }, 5000);
        }, 10000);
    </script>
</body>

</html>
