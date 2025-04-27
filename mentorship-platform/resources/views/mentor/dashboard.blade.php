<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Mentorship Requests -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium mb-2">Pending Requests</h4>
                            <p class="text-sm text-gray-600">Review and respond to mentorship requests from startups.</p>
                            <a href="{{ route('mentorship-requests.index') }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-500">View Requests →</a>
                        </div>

                        <!-- Your Schedule -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium mb-2">Your Schedule</h4>
                            <p class="text-sm text-gray-600">Manage your upcoming mentoring sessions.</p>
                            <a href="{{ route('mentorship-requests.index', ['status' => 'accepted']) }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-500">View Schedule →</a>
                        </div>

                        <!-- Your Profile -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium mb-2">Mentor Profile</h4>
                            <p class="text-sm text-gray-600">Update your expertise and availability.</p>
                            <a href="{{ route('profile.edit') }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-500">Edit Profile →</a>
                        </div>

                        <!-- Messages -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium mb-2">Messages</h4>
                            <p class="text-sm text-gray-600">Check your conversations with startups.</p>
                            <a href="{{ route('mentorship-requests.index', ['view' => 'messages']) }}" class="mt-2 inline-block text-indigo-600 hover:text-indigo-500">Open Messages →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 