<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Messages with {{ auth()->id() === $mentorshipRequest->startup_id ? $mentorshipRequest->mentor->name : $mentorshipRequest->startup->name }}
            </h2>
            <a href="{{ route('mentorship-requests.show', $mentorshipRequest) }}" class="text-blue-600 hover:text-blue-800">
                ← Back to Request
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="space-y-4 mb-6">
                        @forelse($messages as $message)
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