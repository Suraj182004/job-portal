<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'JobSphere') }} - Find Your Dream Job</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Styles & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 selection:bg-blue-500 selection:text-white">
            <!-- Hero Section with Navigation -->
            <div class="relative">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-grid-slate-900/[0.04] dark:bg-grid-slate-400/[0.05] bg-[size:40px_40px] [mask-image:radial-gradient(ellipse_70%_70%_at_50%_0%,#000_70%,transparent_100%)]"></div>
                
                <!-- Navigation Bar -->
                <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-20 items-center justify-between">
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="text-3xl font-black tracking-tight">
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
                                    JOBSPHERE
                                </span>
                            </a>
                        </div>
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 font-medium">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Hero Content -->
                <div class="relative z-10 py-16 md:py-24">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
                        <h1 class="mx-auto max-w-4xl font-display text-5xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-7xl">
                            Find Your 
                            <span class="relative whitespace-nowrap text-blue-600 dark:text-blue-400">
                                <svg aria-hidden="true" viewBox="0 0 418 42" class="absolute left-0 top-2/3 h-[0.58em] w-full fill-blue-300/30 dark:fill-blue-400/30" preserveAspectRatio="none">
                                    <path d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z"></path>
                                </svg>
                                <span class="relative">Dream Job</span>
                            </span>
                        </h1>
                        <p class="mx-auto mt-6 max-w-2xl text-lg tracking-tight text-slate-700 dark:text-slate-300">
                            Your gateway to career opportunities. Find the perfect job match with thousands of listings updated daily.
                        </p>
                        <div class="mt-10 flex justify-center gap-6">
                            <a href="{{ route('jobs.index') }}" class="rounded-md bg-blue-600 px-8 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Browse All Jobs</a>
                            @guest
                                <a href="{{ route('register') }}" class="rounded-md bg-white px-8 py-3 text-sm font-semibold text-blue-600 shadow-sm ring-1 ring-inset ring-blue-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-blue-400 dark:ring-blue-700 dark:hover:bg-gray-700">Sign Up Now</a>
                            @else
                                <a href="{{ route('jobs.create') }}" class="rounded-md bg-white px-8 py-3 text-sm font-semibold text-blue-600 shadow-sm ring-1 ring-inset ring-blue-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-blue-400 dark:ring-blue-700 dark:hover:bg-gray-700">Post a Job</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Section -->
            <div class="mx-auto max-w-7xl px-4 -mt-4 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-xl ring-1 ring-slate-900/5 dark:ring-white/10">
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-50 to-indigo-50 opacity-20 dark:from-blue-900/20 dark:to-indigo-900/20"></div>
                    <div class="relative px-6 py-8 sm:px-10">
                        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Find Your Perfect Job</h2>
                        <form method="GET" action="{{ route('jobs.index') }}" class="space-y-6">
                            <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 md:grid-cols-4 sm:gap-x-6">
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Keywords</label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" name="search" id="search" value="{{ $filters['search'] ?? '' }}" placeholder="Job title, skills..." class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 dark:bg-gray-700/50 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600">
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
                                        <input type="text" name="location" id="location" value="{{ $filters['location'] ?? '' }}" placeholder="City, state or remote" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 dark:bg-gray-700/50 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600">
                                    </div>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Job Type</label>
                                    <select name="type" id="type" class="block w-full rounded-md border-0 py-3 text-gray-900 dark:text-white ring-1 ring-inset ring-gray-300 dark:ring-gray-600 dark:bg-gray-700/50 focus:ring-2 focus:ring-inset focus:ring-blue-600">
                                        <option value="all" {{ ($filters['type'] ?? 'all') == 'all' ? 'selected' : '' }}>All Types</option>
                                        <option value="Full-time" {{ ($filters['type'] ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                        <option value="Part-time" {{ ($filters['type'] ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                        <option value="Internship" {{ ($filters['type'] ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                                        <option value="Contract" {{ ($filters['type'] ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                        <option value="Remote" {{ ($filters['type'] ?? '') == 'Remote' ? 'selected' : '' }}>Remote</option>
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="w-full rounded-md bg-blue-600 py-3 px-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                        Search Jobs
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Recent Job Listings -->
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Recent Job Postings</h2>
                    <a href="{{ route('jobs.index') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200">
                        View all jobs →
                    </a>
                </div>
                
                <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($recentJobs as $job)
                        <div class="group relative overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-md hover:shadow-lg transition-all duration-200 ring-1 ring-gray-200 dark:ring-gray-700">
                            <div class="absolute right-4 top-4 rounded-full bg-blue-100 dark:bg-blue-900/30 px-3 py-1 text-xs font-medium text-blue-800 dark:text-blue-300">
                                {{ $job->type }}
                            </div>
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
                                        <a href="{{ route('jobs.show', $job->id) }}" class="focus:outline-none">
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            {{ $job->title }}
                                        </a>
                                    </h3>
                                </div>
                                <p class="mt-2 line-clamp-2 text-sm text-gray-500 dark:text-gray-400">{{ $job->description }}</p>
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
                        <div class="col-span-full flex items-center justify-center rounded-xl bg-white dark:bg-gray-800 shadow p-8 text-center">
                            <div>
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">No job postings yet</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Be the first to post a job on our platform.</p>
                                <div class="mt-6">
                                    <a href="{{ route('jobs.create') }}" class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Post a Job
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Footer -->
            <footer class="mt-16 border-t border-gray-200 dark:border-gray-800">
                <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                    <div class="flex flex-col items-center justify-between md:flex-row">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl font-black tracking-tight">
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
                                    JOBSPHERE
                                </span>
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">© {{ date('Y') }} All rights reserved.</span>
                        </div>
                        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400 md:mt-0">
                            Find your dream job with JobSphere
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
