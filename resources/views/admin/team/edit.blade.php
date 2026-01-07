<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                ✏️ Edit Team Member
            </h2>
            <a href="{{ route('team-members.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                ← Back to Team
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <x-breadcrumbs :items="[
        ['label' => 'Dashboard', 'url' => route('dashboard')],
        ['label' => 'Manage Team', 'url' => route('team-members.index')],
        ['label' => 'Edit Team Member', 'url' => '#']
    ]" />
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">

                    {{-- Error Messages --}}
                    @if($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <strong class="font-semibold">Please fix the following errors:</strong>
                                    <ul class="mt-2 ml-4 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('team-members.update', $teamMember) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Name Field --}}
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $teamMember->name) }}"
                                    required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none"
                                    placeholder="e.g., Jane Smith">
                            </div>

                            {{-- Position Field --}}
                            <div>
                                <label for="position" class="block text-sm font-bold text-gray-700 mb-2">
                                    Position <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="position" id="position"
                                    value="{{ old('position', $teamMember->position) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none"
                                    placeholder="e.g., Senior Consultant">
                            </div>
                        </div>

                        {{-- Image URL Field --}}
                        <div>
                            <label for="image" class="block text-sm font-bold text-gray-700 mb-2">
                                Profile Image URL (Optional)
                            </label>
                            <input type="text" name="image" id="image" value="{{ old('image', $teamMember->image) }}"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none"
                                placeholder="e.g., https://example.com/photo.jpg">
                            <p class="text-xs text-gray-500 mt-1">Provide a direct link to the team member's photo.</p>
                        </div>

                        {{-- Bio Field --}}
                        <div>
                            <label for="bio" class="block text-sm font-bold text-gray-700 mb-2">
                                Biography <span class="text-red-500">*</span>
                            </label>
                            <textarea name="bio" id="bio" rows="4" required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none resize-none"
                                placeholder="Tell us about this team member...">{{ old('bio', $teamMember->bio) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- LinkedIn Field --}}
                            <div>
                                <label for="linkedin_url" class="block text-sm font-bold text-gray-700 mb-2">
                                    LinkedIn URL (Optional)
                                </label>
                                <input type="url" name="linkedin_url" id="linkedin_url"
                                    value="{{ old('linkedin_url', $teamMember->linkedin_url) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none"
                                    placeholder="https://linkedin.com/in/username">
                            </div>

                            {{-- Twitter Field --}}
                            <div>
                                <label for="twitter_url" class="block text-sm font-bold text-gray-700 mb-2">
                                    Twitter URL (Optional)
                                </label>
                                <input type="url" name="twitter_url" id="twitter_url"
                                    value="{{ old('twitter_url', $teamMember->twitter_url) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition outline-none"
                                    placeholder="https://twitter.com/username">
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-between pt-4 border-t">
                            <a href="{{ route('team-members.index') }}"
                                class="text-gray-600 hover:text-gray-800 font-semibold transition">
                                ← Back to Team
                            </a>
                            <button type="submit"
                                class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                                Update Team Member
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>