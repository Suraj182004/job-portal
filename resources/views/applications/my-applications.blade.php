<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">My Job Applications</h1>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($applications->count() > 0)
                <div class="divide-y">
                    @foreach($applications as $application)
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-xl font-semibold">
                                        <a href="{{ route('jobs.show', $application->job->id) }}" class="text-blue-600 hover:underline">
                                            {{ $application->job->title }}
                                        </a>
                                    </h2>
                                    <p class="text-gray-600 text-sm mt-1">{{ $application->job->location }} | {{ $application->job->type }}</p>
                                    <p class="text-gray-500 text-sm">Applied: {{ $application->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Submitted
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-sm font-semibold">Your Cover Letter:</h3>
                                <p class="text-sm mt-1 text-gray-700">{{ Str::limit($application->cover_letter, 200) }}</p>
                            </div>
                            <div class="mt-3 text-sm">
                                <a href="{{ $application->cv_link }}" target="_blank" class="text-blue-600 hover:underline">View Your CV</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="px-6 py-3 bg-gray-50">
                    {{ $applications->links() }}
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    <p>You haven't applied for any jobs yet.</p>
                    <a href="{{ route('jobs.index') }}" class="mt-2 inline-block text-blue-600 hover:underline">Browse Jobs</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 