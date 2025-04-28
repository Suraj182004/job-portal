<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6">{{ $job->title }}</h1>

        <div class="space-y-4">
            <p class="text-gray-600">{{ $job->location }} | {{ $job->type }}</p>
            <p class="mt-4">{{ $job->description }}</p>
            <p class="mt-4 font-bold">Salary: ${{ $job->salary }}</p>
        </div>

        <a href="{{ route('jobs.index') }}" class="text-blue-600 mt-6 inline-block">Back to Job Listings</a>
    </div>
</x-app-layout>
