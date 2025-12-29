<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 min-h-screen flex items-center justify-center p-4">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    {{-- Login Card --}}
    <div class="relative w-full max-w-md">
        {{-- Logo/Brand Section --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-block">
                <h1 class="text-4xl font-extrabold text-white mb-2 drop-shadow-lg">
                    Business Consultancy
                </h1>
                <p class="text-indigo-100 text-sm font-medium">Admin Portal</p>
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8 backdrop-blur-sm">
            {{ $slot }}
        </div>

        {{-- Back to Website Link --}}
        <div class="text-center mt-6">
            <a href="/" class="text-white hover:text-indigo-100 font-medium text-sm transition flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Website
            </a>
        </div>
    </div>
</body>
</html>