<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Applications for: {{ $job->title }}</h1>
            <a href="{{ route('jobs.show', $job->id) }}" class="text-blue-600 hover:underline">Back to Job</a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold">Job Details</h2>
                    <p class="text-gray-600">{{ $job->location }} | {{ $job->type }}</p>
                    <p class="text-sm text-gray-500">Posted: {{ $job->created_at->format('M d, Y') }}</p>
                </div>
                
                <div class="border-t pt-4">
                    <h2 class="text-lg font-semibold mb-4">{{ $applications->total() }} Applications</h2>
                    
                    @if($applications->count() > 0)
                        <div class="space-y-4">
                            @foreach($applications as $application)
                                <div class="border rounded-lg p-4 bg-gray-50">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-semibold">{{ $application->user->name }}</h3>
                                            <p class="text-sm text-gray-600">{{ $application->user->email }} | {{ $application->phone }}</p>
                                            <p class="text-sm text-gray-500">Applied: {{ $application->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div>
                                            <a href="{{ $application->cv_link }}" target="_blank" class="text-blue-600 hover:underline text-sm">View CV</a>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h4 class="text-sm font-semibold">Cover Letter:</h4>
                                        <p class="text-sm mt-1">{{ $application->cover_letter }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4">
                            {{ $applications->links() }}
                        </div>
                    @else
                        <p class="text-gray-500">No applications have been submitted yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 