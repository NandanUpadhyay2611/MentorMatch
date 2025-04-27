<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="bio" :value="__('Bio')" />
                            <textarea id="bio" name="bio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4">{{ old('bio', $profile->bio) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                        </div>

                        <div>
                            <x-input-label for="expertise" :value="__('Expertise')" />
                            <input type="text" id="expertise" name="expertise" value="{{ old('expertise', $profile->expertise) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., Software Development, Marketing, Business Strategy">
                            <x-input-error class="mt-2" :messages="$errors->get('expertise')" />
                        </div>

                        <div>
                            <x-input-label for="skills" :value="__('Skills')" />
                            <div class="mt-2 space-y-2" id="skills-container">
                                @foreach(old('skills', $profile->skills ?? []) as $skill)
                                    <div class="flex gap-2">
                                        <input type="text" name="skills[]" value="{{ $skill }}" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <button type="button" class="text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addSkillField()" class="mt-2 text-sm text-indigo-600 hover:text-indigo-900">Add Skill</button>
                            <x-input-error class="mt-2" :messages="$errors->get('skills')" />
                        </div>

                        <div>
                            <x-input-label for="experience" :value="__('Experience')" />
                            <textarea id="experience" name="experience" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4">{{ old('experience', $profile->experience) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('experience')" />
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="availability" value="1" {{ old('availability', $profile->availability) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-600">Available for Mentorship</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function addSkillField() {
            const container = document.getElementById('skills-container');
            const div = document.createElement('div');
            div.className = 'flex gap-2';
            div.innerHTML = `
                <input type="text" name="skills[]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <button type="button" class="text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">Remove</button>
            `;
            container.appendChild(div);
        }
    </script>
    @endpush
</x-app-layout>
