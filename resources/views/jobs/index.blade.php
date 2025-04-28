<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6">All Jobs</h1>

       <div class="space-y-4">
    @foreach($jobs as $job)
        <div class="bg-gray-100 p-4 rounded shadow">
            <h2 class="text-xl font-semibold">
                <a href="{{ route('jobs.show', $job->id) }}" class="text-blue-600">
                    {{ $job->title }}
                </a>
            </h2>
            <p class="text-gray-600">{{ $job->location }} | {{ $job->type }}</p>
            <p class="mt-2">{{ $job->description }}</p>
            <p class="mt-2 font-bold">Salary: ${{ $job->salary }}</p>
        </div>
    @endforeach
</div>

        
        <!-- Pagination links -->
        <div class="mt-6">
            {{ $jobs->links() }}
        </div>
    </div>
</x-app-layout>
