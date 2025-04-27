<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Mentorship Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('mentorship-requests.store') }}" class="space-y-6">
                        @csrf

                        <!-- Mentor Selection -->
                        <div>
                            <label for="mentor_id" class="block text-sm font-medium text-gray-700">Select Mentor</label>
                            <select name="mentor_id" id="mentor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required {{ $selectedMentor ? 'disabled' : '' }}>
                                <option value="">Choose a mentor...</option>
                                @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}" {{ $selectedMentor && $selectedMentor->id === $mentor->id ? 'selected' : '' }}>
                                        {{ $mentor->name }} - {{ implode(', ', array_slice($mentor->profile->skills ?? [], 0, 3)) }}
                                    </option>
                                @endforeach
                            </select>
                            @if($selectedMentor)
                                <input type="hidden" name="mentor_id" value="{{ $selectedMentor->id }}">
                            @endif
                            @error('mentor_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Topic -->
                        <div>
                            <label for="topic" class="block text-sm font-medium text-gray-700">Topic</label>
                            <input type="text" name="topic" id="topic" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('topic') }}">
                            @error('topic')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea name="message" id="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Proposed Time -->
                        <div>
                            <label for="proposed_time" class="block text-sm font-medium text-gray-700">Proposed Time</label>
                            <input type="datetime-local" name="proposed_time" id="proposed_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('proposed_time') }}">
                            @error('proposed_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Send Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 