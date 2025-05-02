<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Browse Jobs') }}
            </h2>
            <a href="{{ route('jobs.create') }}" 
               class="inline-flex items-center px-3 py-2 bg-blue-600 border border-transparent rounded-md text-xs font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Post a Job
            </a>
        </div>
    </x-slot>

    {{-- Search Section --}}
    <div class="mb-8">
        <div class="relative overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-md ring-1 ring-slate-900/5 dark:ring-white/10">
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-50 to-indigo-50 opacity-20 dark:from-blue-900/20 dark:to-indigo-900/20"></div>
            <div class="relative px-6 py-6 sm:px-8">
                <form method="GET" action="{{ route('jobs.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 md:grid-cols-4 sm:gap-x-6">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Keywords</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search" value="{{ $filters['search'] ?? '' }}" placeholder="Job title, skills..." class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 dark:bg-gray-700/50 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600">
                            </div>
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="location" id="location" value="{{ $filters['location'] ?? '' }}" placeholder="City, state or remote" class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 dark:bg-gray-700/50 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600">
                            </div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Job Type</label>
                            <select name="type" id="type" class="block w-full rounded-md border-0 py-2.5 text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 dark:bg-gray-700/50 focus:ring-2 focus:ring-inset focus:ring-blue-600">
                                <option value="all" {{ ($filters['type'] ?? 'all') == 'all' ? 'selected' : '' }}>All Types</option>
                                <option value="Full-time" {{ ($filters['type'] ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ ($filters['type'] ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Internship" {{ ($filters['type'] ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Contract" {{ ($filters['type'] ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Remote" {{ ($filters['type'] ?? '') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full rounded-md bg-blue-600 py-2.5 px-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                Search Jobs
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Results Info --}}
    <div class="mb-6 flex justify-between items-center">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ $jobs->total() }} job{{ $jobs->total() !== 1 ? 's' : '' }} found
            @if(($filters['search'] ?? null) || ($filters['location'] ?? null) || (($filters['type'] ?? 'all') !== 'all'))
                <span class="text-xs ml-1">
                    (filtered results)
                </span>
            @endif
        </p>
        <div class="flex items-center">
            <span class="text-sm text-gray-600 dark:text-gray-400 mr-2">Sort by:</span>
            <select onchange="window.location.href=this.value" class="text-sm border-0 py-1.5 px-2 rounded-md text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 dark:bg-gray-700/50 focus:ring-2 focus:ring-inset focus:ring-blue-600">
                <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') === 'newest' || !request('sort') ? 'selected' : '' }}>
                    Newest
                </option>
                <option value="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                    Oldest
                </option>
                <!-- Add more sorting options if needed -->
            </select>
        </div>
    </div>

    {{-- Job Listings --}}
    <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
        @forelse($jobs as $job)
            <div class="group relative overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-md hover:shadow-lg transition-all duration-200 ring-1 ring-gray-200 dark:ring-gray-700">
                <div class="absolute right-4 top-4 rounded-full bg-blue-100 dark:bg-blue-900/30 px-3 py-1 text-xs font-medium text-blue-800 dark:text-blue-300">
                    {{ $job->type }}
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                            <a href="{{ route('jobs.show', $job->id) }}" class="focus:outline-none">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                {{ $job->title }}
                            </a>
                        </h3>
                        <p class="mt-1 line-clamp-2 text-sm text-gray-500 dark:text-gray-400">{{ $job->description }}</p>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $job->location }}</span>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        @if($job->salary)
                            <span class="text-sm font-medium text-gray-900 dark:text-white">${{ number_format($job->salary, 2) }}/year</span>
                        @else
                            <span class="text-sm text-gray-500 dark:text-gray-400">Salary not specified</span>
                        @endif
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 flex flex-col items-center justify-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No jobs found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md">We couldn't find any jobs matching your criteria. Try adjusting your search filters or check back later.</p>
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Clear filters
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination links --}}
    <div class="mt-8">
        {{ $jobs->links() }}
    </div>

    {{-- Display Success/Error Messages --}}
    @if(session('success'))
        <div class="mt-6 p-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-400 dark:border-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mt-6 p-4 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-400 dark:border-red-800 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
</x-app-layout>
