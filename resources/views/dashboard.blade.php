<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-800 dark:to-indigo-900 rounded-xl shadow-lg overflow-hidden">
            <div class="relative px-6 py-10 sm:px-10">
                <div class="absolute right-0 top-0 -mt-20 -mr-20 opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="260" height="260" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </div>
                <div class="relative">
                    <h3 class="text-2xl font-bold text-white mb-1">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="text-blue-100">Manage your job postings and applications all in one place.</p>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Your Job Postings</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $postedJobs->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Your Applications</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $applications->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- My Job Postings Section --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl">
            <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">My Job Postings</h3>
                <a href="{{ route('jobs.create') }}" 
                   class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md text-xs font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Post Job
                </a>
            </div>
            <div class="p-6">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($postedJobs as $job)
                        <div class="py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                            <div class="mb-2 sm:mb-0">
                                <a href="{{ route('jobs.show', $job->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold">{{ $job->title }}</a>
                                <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400 space-x-2">
                                    <span>{{ $job->location }}</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                        {{ $job->type }}
                                    </span>
                                    <span>{{ $job->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('jobs.applications', $job->id) }}" 
                                   class="inline-flex items-center px-2.5 py-1.5 bg-green-50 dark:bg-green-900/20 border border-transparent rounded text-xs font-medium text-green-700 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-900/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>
                                    {{ $job->applications()->count() }} Applications
                                </a>
                                <a href="{{ route('jobs.edit', $job->id) }}" 
                                   class="inline-flex items-center px-2.5 py-1.5 bg-yellow-50 dark:bg-yellow-900/20 border border-transparent rounded text-xs font-medium text-yellow-700 dark:text-yellow-400 hover:bg-yellow-100 dark:hover:bg-yellow-900/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('jobs.destroy', $job->id) }}" onsubmit="return confirm('Are you sure you want to delete this job?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="inline-flex items-center px-2.5 py-1.5 bg-red-50 dark:bg-red-900/20 border border-transparent rounded text-xs font-medium text-red-700 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 flex flex-col items-center justify-center text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 mb-2">You haven't posted any jobs yet</p>
                            <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Post Your First Job
                            </a>
                        </div>
                    @endforelse
                </div>
                {{-- Pagination for posted jobs --}}
                @if($postedJobs->hasPages())
                    <div class="mt-6">
                        {{ $postedJobs->links() }}
                    </div>
                @endif
            </div>
        </div>

        {{-- My Applications Section --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl">
            <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">My Applications</h3>
                <a href="{{ route('my.applications') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="p-6">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($applications as $application)
                        <div class="py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                            <div>
                                <a href="{{ route('jobs.show', $application->job->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold">{{ $application->job->title }}</a>
                                <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400 space-x-2">
                                    <span>{{ $application->job->location }}</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                        {{ $application->job->type }}
                                    </span>
                                    <span class="text-gray-500 dark:text-gray-400">Applied: {{ $application->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                    <svg class="mr-1 h-2 w-2 text-indigo-500" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Pending
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 flex flex-col items-center justify-center text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 mb-2">You haven't applied for any jobs yet</p>
                            <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Browse Jobs
                            </a>
                        </div>
                    @endforelse
                </div>
                {{-- Pagination for applications --}}
                @if($applications->hasPages())
                    <div class="mt-6">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
