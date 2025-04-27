<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MentorMatch</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-[#0f172a]">
        <div class="relative min-h-screen">
            @if (Route::has('login'))
                <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-300 hover:text-white underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-300 hover:text-white underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-white sm:text-5xl md:text-6xl">
                        <span class="block">Welcome to</span>
                        <span class="block text-[#818cf8]">MentorMatch</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-gray-400 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        Connect with experienced mentors and take your startup journey to the next level.
                    </p>
                </div>

                <div class="mt-16">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        <!-- For Startups -->
                        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-[#1e293b] border border-gray-700">
                            <div class="flex-1 p-6 flex flex-col justify-between">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-white">For Startups</h3>
                                    <p class="mt-3 text-base text-gray-400">
                                        Get guidance from experienced mentors who can help you navigate challenges and grow your business.
                                    </p>
                                </div>
                                <div class="mt-6">
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#818cf8] hover:bg-[#6366f1] transition-colors duration-200">
                                        Join as Startup
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- For Mentors -->
                        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-[#1e293b] border border-gray-700">
                            <div class="flex-1 p-6 flex flex-col justify-between">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-white">For Mentors</h3>
                                    <p class="mt-3 text-base text-gray-400">
                                        Share your expertise and experience with ambitious startups. Make a difference in their journey.
                                    </p>
                                </div>
                                <div class="mt-6">
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#818cf8] hover:bg-[#6366f1] transition-colors duration-200">
                                        Join as Mentor
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- How It Works -->
                        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-[#1e293b] border border-gray-700">
                            <div class="flex-1 p-6 flex flex-col justify-between">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-white">How It Works</h3>
                                    <p class="mt-3 text-base text-gray-400">
                                        Simple and effective mentorship process:
                                        <ul class="mt-2 list-disc list-inside">
                                            <li>Create your profile</li>
                                            <li>Connect with mentors/startups</li>
                                            <li>Schedule sessions</li>
                                            <li>Grow together</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="mt-6">
                                    <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#818cf8] hover:bg-[#6366f1] transition-colors duration-200">
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="mt-16">
                    <div class="text-center">
                        <h2 class="text-3xl font-extrabold text-white">
                            Platform Features
                        </h2>
                        <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-400">
                            Everything you need to make mentorship effective and impactful.
                        </p>
                    </div>

                    <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#818cf8] text-white">
                                    <!-- Heroicon name: outline/chat -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-white">Messaging System</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-400">
                                Direct communication between mentors and startups through our secure messaging platform.
                            </dd>
                        </div>

                        <!-- Feature 2 -->
                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#818cf8] text-white">
                                    <!-- Heroicon name: outline/calendar -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-white">Session Scheduling</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-400">
                                Easy-to-use calendar integration for scheduling mentorship sessions.
                            </dd>
                        </div>

                        <!-- Feature 3 -->
                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-[#818cf8] text-white">
                                    <!-- Heroicon name: outline/video-camera -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-white">Video Calls</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-400">
                                Built-in video calling for remote mentorship sessions.
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-[#1e293b] mt-12 border-t border-gray-700">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
                    <div class="flex justify-center space-x-6 md:order-2">
                        <a href="#" class="text-gray-400 hover:text-gray-300">
                            <span class="sr-only">About</span>
                            About
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300">
                            <span class="sr-only">Contact</span>
                            Contact
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300">
                            <span class="sr-only">Privacy</span>
                            Privacy
                        </a>
                    </div>
                    <div class="mt-8 md:mt-0 md:order-1">
                        <p class="text-center text-base text-gray-400">
                            &copy; {{ date('Y') }} MentorMatch. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
