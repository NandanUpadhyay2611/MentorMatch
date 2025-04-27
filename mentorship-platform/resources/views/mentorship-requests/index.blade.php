<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mentorship Requests') }}
            </h2>
            @if(auth()->user()->role === 'startup')
                <a href="{{ route('mentorship-requests.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    New Request
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($requests->count() > 0)
                        <div class="space-y-6">
                            @foreach($requests as $request)
                                <div class="border rounded-lg p-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="flex items-center gap-4 mb-2">
                                                <h3 class="text-lg font-semibold">{{ $request->topic }}</h3>
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($request->status === 'accepted') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">
                                                @if(auth()->user()->role === 'mentor')
                                                    From: {{ $request->startup->name }}
                                                @else
                                                    To: {{ $request->mentor->name }}
                                                @endif
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                @if($request->status === 'accepted')
                                                    Scheduled for: {{ $request->confirmed_time->format('M d, Y H:i') }}
                                                @else
                                                    Proposed for: {{ $request->proposed_time->format('M d, Y H:i') }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="space-x-2">
                                            <a href="{{ route('mentorship-requests.show', $request) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No mentorship requests found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 