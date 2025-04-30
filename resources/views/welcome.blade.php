<x-app-layout>
    {{-- Hero Section --}}
    <div class="bg-indigo-600 text-white pt-20 pb-24">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Find Your Next Opportunity</h1>
            <p class="text-lg md:text-xl mb-8 text-indigo-200">Your journey to a new career starts here. Search thousands of jobs.</p>

            {{-- Search Form --}}
            {{-- Point this form to the jobs index route or a dedicated search route --}}
            <form action="{{ route('jobs.index') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="flex flex-col md:flex-row items-center bg-white rounded-lg shadow-lg p-2">
                    <input type="text"
                           name="search" {{-- Use 'search' or a similar query parameter --}}
                           placeholder="Keyword, skill, or company"
                           class="flex-grow p-3 text-gray-700 border-none rounded-t-lg md:rounded-l-lg md:rounded-tr-none focus:ring-indigo-500 focus:ring-2 mb-2 md:mb-0 md:mr-2"
                           value="{{ request('search') }}"> {{-- Pre-fill if needed --}}
                    <input type="text"
                           name="location" {{-- Add a location parameter --}}
                           placeholder="Location (e.g., city, state)"
                           class="flex-grow p-3 text-gray-700 border-none focus:ring-indigo-500 focus:ring-2 mb-2 md:mb-0 md:mr-2"
                           value="{{ request('location') }}"> {{-- Pre-fill if needed --}}
                    <button type="submit"
                            class="w-full md:w-auto bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-b-lg md:rounded-r-lg md:rounded-bl-none transition duration-150 ease-in-out">
                        Search Jobs
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Optional: Featured Jobs Section --}}
    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-gray-800 dark:text-gray-200">Featured Jobs</h2>
            <div class="text-center text-gray-600 dark:text-gray-400">
                {{-- Placeholder: Add logic to display featured jobs here --}}
                {{-- Example: Loop through a $featuredJobs variable passed from the controller --}}
                <p>Featured job listings will appear here soon.</p>
                <a href="{{ route('jobs.index') }}" class="mt-4 inline-block text-indigo-600 dark:text-indigo-400 hover:underline">View All Jobs</a>
            </div>
        </div>
    </div>

    {{-- Optional: Browse Categories Section --}}
    {{-- You would need a categories table and model for this --}}
    <div class="py-12 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-gray-800 dark:text-gray-200">Browse by Category</h2>
            <div class="text-center text-gray-600 dark:text-gray-400">
                {{-- Placeholder: Add logic to display job categories here --}}
                {{-- Example: Loop through a $categories variable --}}
                <p>Job categories will be listed here.</p>
                {{-- Example category links --}}
                {{-- <div class="flex flex-wrap justify-center gap-4 mt-4">
                    <a href="#" class="bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-full text-sm hover:bg-gray-300 dark:hover:bg-gray-600">Technology</a>
                    <a href="#" class="bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-full text-sm hover:bg-gray-300 dark:hover:bg-gray-600">Marketing</a>
                    <a href="#" class="bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-full text-sm hover:bg-gray-300 dark:hover:bg-gray-600">Sales</a>
                    <a href="#" class="bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-full text-sm hover:bg-gray-300 dark:hover:bg-gray-600">Healthcare</a>
                </div> --}}
            </div>
        </div>
    </div>

</x-app-layout>
