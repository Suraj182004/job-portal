<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        {{-- Job Header --}}
        <div class="border-b dark:border-gray-700 pb-4 mb-6">
            <div class="flex justify-between items-start">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $job->title }}</h1>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                    {{ $job->type }}
                </span>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mt-2 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $job->location }}
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">Posted {{ $job->created_at->diffForHumans() }}</p>
        </div>

        {{-- Job Details --}}
        <div class="space-y-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">Description</h2>
                <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                    {{ $job->description }}
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Compensation</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($job->salary, 2) }}</p>
            </div>

            {{-- Employer Info (if we later add company profiles) --}}
            {{-- <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">About the Company</h2>
                <p class="text-gray-700 dark:text-gray-300">{{ $job->user->name }}</p>
            </div> --}}
        </div>

        {{-- Action Buttons --}}
        <div class="mt-8 pt-6 border-t dark:border-gray-700 flex justify-between items-center">
            <a href="{{ route('jobs.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Job Listings
            </a>

            <div class="flex items-center space-x-3">
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition">
                        Apply Now (Register)
                    </a>
                @endguest

                @auth
                    @php
                        // Check if the current user has already applied for this specific job
                        $hasApplied = auth()->user()->jobApplications()->where('job_id', $job->id)->exists();
                        $isPoster = auth()->id() === $job->user_id;
                    @endphp

                    @if (!$isPoster && !$hasApplied)
                        {{-- Show Apply form for eligible logged-in users --}}
                        <a href="{{ route('jobs.apply.form', $job->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition">
                            Apply Now
                        </a>
                    @elseif ($hasApplied)
                        {{-- Show Applied status if user has applied --}}
                        <span class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest disabled:opacity-75 transition cursor-not-allowed">
                            Applied
                        </span>
                    @endif

                    @if ($isPoster)
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('jobs.applications', $job->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition">
                                View Applications
                            </a>
                        </div>
                    @endif
                @endauth

                @can('update', $job)
                    <a href="{{ route('jobs.edit', $job->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition">
                        Edit Job
                    </a>
                @endcan

                @can('delete', $job)
                    <form method="POST" action="{{ route('jobs.destroy', $job->id) }}" onsubmit="return confirm('Are you sure you want to delete this job? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition">
                            Delete Job
                        </button>
                    </form>
                @endcan
            </div>
        </div>

        {{-- Notifications --}}
        @if(session('success'))
            <div class="mt-6 p-4 bg-green-100 text-green-700 border border-green-400 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mt-6 p-4 bg-red-100 text-red-700 border border-red-400 rounded-md">
                {{ session('error') }}
            </div>
        @endif
    </div>
</x-app-layout>
