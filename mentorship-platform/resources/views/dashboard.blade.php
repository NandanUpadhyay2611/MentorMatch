<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(auth()->user()->role === 'mentor')
                <!-- Mentor Dashboard -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Pending Mentorship Requests</h3>
                        @if($pendingRequests->count() > 0)
                            <div class="space-y-4">
                                @foreach($pendingRequests as $request)
                                    <div class="border rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium">{{ $request->startup->name }}</h4>
                                                <p class="text-sm text-gray-600">Topic: {{ $request->topic }}</p>
                                                <p class="text-sm text-gray-600">Proposed Time: {{ $request->proposed_time->format('M d, Y H:i') }}</p>
                                                <p class="mt-2">{{ $request->message }}</p>
                                            </div>
                                            <div class="space-x-2">
                                                <a href="{{ route('mentorship-requests.show', $request) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600">No pending mentorship requests.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Upcoming Sessions</h3>
                        @if($upcomingSessions->count() > 0)
                            <div class="space-y-4">
                                @foreach($upcomingSessions as $session)
                                    <div class="border rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium">{{ $session->startup->name }}</h4>
                                                <p class="text-sm text-gray-600">Topic: {{ $session->topic }}</p>
                                                <p class="text-sm text-gray-600">Time: {{ $session->confirmed_time->format('M d, Y H:i') }}</p>
                                            </div>
                                            <div class="space-x-2">
                                                <a href="{{ route('mentorship-requests.show', $session) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                                    Join Session
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600">No upcoming sessions.</p>
                        @endif
                    </div>
                </div>
            @else
                <!-- Startup Dashboard -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">My Mentorship Requests</h3>
                            <a href="{{ route('mentorship-requests.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                New Request
                            </a>
                        </div>
                        @if($myRequests->count() > 0)
                            <div class="space-y-4">
                                @foreach($myRequests as $request)
                                    <div class="border rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium">{{ $request->mentor->name }}</h4>
                                                <p class="text-sm text-gray-600">Topic: {{ $request->topic }}</p>
                                                <p class="text-sm text-gray-600">Status: 
                                                    <span class="px-2 py-1 text-xs rounded-full
                                                        @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @elseif($request->status === 'accepted') bg-green-100 text-green-800
                                                        @else bg-red-100 text-red-800
                                                        @endif">
                                                        {{ ucfirst($request->status) }}
                                                    </span>
                                                </p>
                                                @if($request->confirmed_time)
                                                    <p class="text-sm text-gray-600">Scheduled for: {{ $request->confirmed_time->format('M d, Y H:i') }}</p>
                                                @endif
                                            </div>
                                            <div class="space-x-2">
                                                <a href="{{ route('mentorship-requests.show', $request) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600">No mentorship requests yet. Create one to get started!</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Available Mentors</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($availableMentors as $mentor)
                                <div class="border rounded-lg p-4">
                                    <h4 class="font-medium">{{ $mentor->name }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($mentor->profile->bio, 100) }}</p>
                                    <div class="mt-2">
                                        <h5 class="text-sm font-medium text-gray-700">Skills:</h5>
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach(array_slice($mentor->profile->skills, 0, 3) as $skill)
                                                <span class="px-2 py-1 text-xs bg-gray-100 rounded-full">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('mentors.show', $mentor) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                            View Profile
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
