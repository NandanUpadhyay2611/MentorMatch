<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Mentors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($mentors->isEmpty())
                        <p class="text-gray-500 text-center py-4">No mentors are currently available.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($mentors as $mentor)
                                <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-xl font-semibold text-gray-800">{{ $mentor->name }}</h3>
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $mentor->profile->availability ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $mentor->profile->availability ? 'Available' : 'Unavailable' }}
                                            </span>
                                        </div>
                                        
                                        @if($mentor->profile)
                                            @if($mentor->profile->expertise)
                                                <p class="text-sm text-gray-600 mb-2">
                                                    <span class="font-medium">Expertise:</span> {{ $mentor->profile->expertise }}
                                                </p>
                                            @endif
                                            
                                            @if($mentor->profile->bio)
                                                <p class="text-sm text-gray-600 mb-4">{{ Str::limit($mentor->profile->bio, 150) }}</p>
                                            @endif
                                        @endif

                                        <div class="mt-4 flex justify-between items-center">
                                            <a href="{{ route('mentors.show', $mentor) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                View Profile
                                            </a>
                                            
                                            @if(auth()->user()->role === 'startup' && $mentor->profile->availability)
                                                <a href="{{ route('mentorship-requests.create', ['mentor_id' => $mentor->id]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                                    Request Mentorship
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($mentors->hasPages())
                            <div class="mt-6">
                                {{ $mentors->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 