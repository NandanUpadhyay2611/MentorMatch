<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Startup Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Available Mentors -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium mb-2">Available Mentors</h4>
                            <p class="text-sm text-gray-600">Connect with experienced mentors in your field.</p>
                            <a href="{{ route('mentors.index') }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-500">Browse Mentors →</a>
                        </div>

                        <!-- Your Requests -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium mb-2">Your Mentorship Requests</h4>
                            <p class="text-sm text-gray-600">Track your active and pending mentorship requests.</p>
                            <a href="{{ route('mentorship-requests.index') }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-500">View Requests →</a>
                        </div>

                        <!-- Upcoming Sessions -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium mb-2">Upcoming Sessions</h4>
                            <p class="text-sm text-gray-600">View your scheduled mentoring sessions.</p>
                            <a href="{{ route('mentorship-requests.index', ['status' => 'accepted']) }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-500">View Schedule →</a>
                        </div>

                        <!-- Messages -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium mb-2">Messages</h4>
                            <p class="text-sm text-gray-600">Check your conversations with mentors.</p>
                            <a href="{{ route('mentorship-requests.index', ['view' => 'messages']) }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-500">Open Messages →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 