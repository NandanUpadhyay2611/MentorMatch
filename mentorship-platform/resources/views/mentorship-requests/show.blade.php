<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mentorship Request Details') }}
            </h2>
            <a href="{{ route('mentorship-requests.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Back to Requests
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Request Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-4 mb-4">
                                <h3 class="text-lg font-semibold">{{ $mentorshipRequest->topic }}</h3>
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($mentorshipRequest->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($mentorshipRequest->status === 'accepted') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($mentorshipRequest->status) }}
                                </span>
                                @if($mentorshipRequest->status === 'accepted')
                                    <a href="{{ route('video-call.index', $mentorshipRequest) }}" 
                                       class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                        Join Video Call
                                    </a>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700">From</h4>
                                    <p>{{ $mentorshipRequest->startup->name }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-700">To</h4>
                                    <p>{{ $mentorshipRequest->mentor->name }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-700">Message</h4>
                                    <p class="text-gray-600">{{ $mentorshipRequest->message }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-700">
                                        {{ $mentorshipRequest->status === 'accepted' ? 'Scheduled Time' : 'Proposed Time' }}
                                    </h4>
                                    <p>{{ $mentorshipRequest->status === 'accepted' ? $mentorshipRequest->confirmed_time->format('M d, Y H:i') : $mentorshipRequest->proposed_time->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->role === 'mentor' && $mentorshipRequest->status === 'pending')
                            <div>
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <h3 class="text-lg font-semibold mb-4">Response Actions</h3>
                                    <form action="{{ route('mentorship-requests.update', $mentorshipRequest) }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label for="confirmed_time" class="block text-sm font-medium text-gray-700">Confirm Time</label>
                                            <input type="datetime-local" name="confirmed_time" id="confirmed_time" 
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                value="{{ old('confirmed_time', $mentorshipRequest->proposed_time->format('Y-m-d\TH:i')) }}">
                                        </div>

                                        <div class="flex gap-2">
                                            <button type="submit" name="status" value="accepted" 
                                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                                Accept
                                            </button>
                                            <button type="submit" name="status" value="rejected"
                                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                                Reject
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Messages Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Messages</h3>
                    
                    <div class="space-y-4 mb-6">
                        @forelse($mentorshipRequest->messages as $message)
                            <div class="flex gap-4 {{ $message->from_user_id === auth()->id() ? 'flex-row-reverse' : '' }}">
                                <div class="flex-1 max-w-lg">
                                    <div class="rounded-lg p-4 {{ $message->from_user_id === auth()->id() ? 'bg-blue-100' : 'bg-gray-100' }}">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="font-medium">{{ $message->sender->name }}</span>
                                            <span class="text-xs text-gray-500">{{ $message->created_at->format('M d, H:i') }}</span>
                                        </div>
                                        <p class="text-gray-700">{{ $message->body }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-600">No messages yet.</p>
                        @endforelse
                    </div>

                    @if($mentorshipRequest->status !== 'rejected')
                        <form action="{{ route('messages.store', $mentorshipRequest) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="body" class="sr-only">Message</label>
                                <textarea name="body" id="body" rows="3" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Type your message here..."></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 