<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $mentor->name }}'s Profile
            </h2>
            <a href="{{ route('mentors.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                ← Back to Mentors
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Main Profile Info -->
                        <div class="md:col-span-2">
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $mentor->name }}</h3>
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $mentor->profile->availability ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $mentor->profile->availability ? 'Available for Mentoring' : 'Currently Unavailable' }}
                                    </span>
                                </div>

                                @if($mentor->profile)
                                    @if($mentor->profile->expertise)
                                        <div class="mb-4">
                                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Expertise</h4>
                                            <p class="text-gray-900">{{ $mentor->profile->expertise }}</p>
                                        </div>
                                    @endif

                                    @if($mentor->profile->bio)
                                        <div class="mb-4">
                                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">About</h4>
                                            <p class="text-gray-900 whitespace-pre-line">{{ $mentor->profile->bio }}</p>
                                        </div>
                                    @endif

                                    @if($mentor->profile->experience)
                                        <div class="mb-4">
                                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Experience</h4>
                                            <p class="text-gray-900 whitespace-pre-line">{{ $mentor->profile->experience }}</p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Request Mentorship</h4>
                                @if(auth()->user()->role === 'startup')
                                    @if($mentor->profile->availability)
                                        <p class="text-sm text-gray-600 mb-4">
                                            {{ $mentor->name }} is currently accepting mentorship requests. Send a request to start your mentorship journey.
                                        </p>
                                        <a href="{{ route('mentorship-requests.create', ['mentor_id' => $mentor->id]) }}" 
                                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Request Mentorship
                                        </a>
                                    @else
                                        <p class="text-sm text-gray-500">
                                            {{ $mentor->name }} is currently not accepting new mentorship requests.
                                        </p>
                                    @endif
                                @else
                                    <p class="text-sm text-gray-500">
                                        You must be registered as a startup to request mentorship.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 