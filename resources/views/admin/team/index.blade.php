<x-app-layout>
    <x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            👥 Manage Team Members
        </h2>
        <div class="flex gap-3">
            <a href="{{ route('dashboard') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                ← Back to Dashboard
            </a>
            <a href="{{ route('team-members.create') }}" 
               class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                ✨ Add New Member
            </a>
        </div>
    </div>
</x-slot>

    <div class="py-12">
        <x-breadcrumbs :items="[
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Manage Team', 'url' => route('team-members.index')]
        ]" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6 shadow-md animate-pulse">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="font-semibold">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($teamMembers->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($teamMembers as $member)
                                <div class="bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-xl p-6 hover:shadow-xl hover:border-indigo-300 transition duration-300 transform hover:-translate-y-1">
                                    {{-- Member Info --}}
                                    <div class="flex flex-col items-center mb-6">
                                        @if($member->image)
                                            <img src="{{ $member->image }}" alt="{{ $member->name }}" class="w-24 h-24 rounded-full object-cover mb-4 border-4 border-indigo-100 shadow-md">
                                        @else
                                            <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-3xl mb-4 border-4 border-indigo-50 shadow-md">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <h3 class="text-xl font-bold text-gray-800 leading-tight mb-1">
                                            {{ $member->name }}
                                        </h3>
                                        <p class="text-sm font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                                            {{ $member->position }}
                                        </p>
                                    </div>

                                    {{-- Bio --}}
                                    <p class="text-gray-600 text-sm mb-6 text-center line-clamp-3">
                                        {{ Str::limit($member->bio, 100) }}
                                    </p>

                                    {{-- Social Links --}}
                                    <div class="flex justify-center gap-4 mb-6">
                                        @if($member->linkedin_url)
                                            <a href="{{ $member->linkedin_url }}" target="_blank" class="text-gray-400 hover:text-blue-600 transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                            </a>
                                        @endif
                                        @if($member->twitter_url)
                                            <a href="{{ $member->twitter_url }}" target="_blank" class="text-gray-400 hover:text-blue-400 transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                            </a>
                                        @endif
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex gap-3 border-t pt-4">
                                        <a href="{{ route('team-members.edit', $member) }}" 
                                           class="flex-1 bg-indigo-500 hover:bg-indigo-600 text-white text-center py-2 px-4 rounded-lg font-semibold transition duration-300 flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('team-members.destroy', $member) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this team member?');"
                                              class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg font-semibold transition duration-300 flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 text-center text-gray-600">
                            <strong>Total Members:</strong> {{ $teamMembers->count() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">👥</div>
                            <p class="text-xl text-gray-600 mb-4">No team members yet</p>
                            <a href="{{ route('team-members.create') }}" 
                               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition">
                                Add Your First Team Member
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
