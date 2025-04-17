<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <div class="border-b dark:border-gray-700 pb-4 mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Edit Job</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $job->title }}</p>
        </div>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 border border-red-400 dark:border-red-700 rounded-lg">
                <div class="font-semibold mb-2">Please correct the following errors:</div>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('jobs.update', $job->id) }}">
            @csrf
            @method('PUT') {{-- Specify PUT method for update --}}

            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Job Title</label>
                    <input type="text" name="title" id="title" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                        value="{{ old('title', $job->title) }}" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Job Description</label>
                    <textarea name="description" id="description" rows="6" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                        required>{{ old('description', $job->description) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Provide a detailed description of job responsibilities and requirements.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location</label>
                        <input type="text" name="location" id="location" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                            value="{{ old('location', $job->location) }}" required>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Job Type</label>
                        <select name="type" id="type" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                            required>
                            <option value="Full-time" {{ old('type', $job->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('type', $job->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Internship" {{ old('type', $job->type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                            <option value="Contract" {{ old('type', $job->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Remote" {{ old('type', $job->type) == 'Remote' ? 'selected' : '' }}>Remote</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Salary (USD)
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
                        </div>
                        <input type="number" name="salary" id="salary" step="0.01" min="0"
                            class="w-full pl-7 px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" 
                            value="{{ old('salary', $job->salary) }}">
                    </div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Enter the annual salary (optional)</p>
                </div>
            </div>

            <div class="flex justify-end mt-8 pt-6 border-t dark:border-gray-700">
                <a href="{{ route('jobs.show', $job->id) }}" 
                    class="mr-4 inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </a>
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Update Job
                </button>
            </div>
        </form>
    </div>
</x-app-layout> 