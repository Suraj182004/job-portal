<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Apply for: {{ $job->title }}</h1>
        
        <div class="mb-6 p-4 bg-gray-100 rounded">
            <h2 class="text-lg font-semibold">Job Details</h2>
            <p class="text-gray-600 mt-2">{{ $job->location }} | {{ $job->type }}</p>
            <p class="mt-2">{{ Str::limit($job->description, 200) }}</p>
            <p class="mt-2 font-bold">Salary: ${{ number_format($job->salary, 2) }}</p>
        </div>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('jobs.apply', $job->id) }}">
            @csrf

            <div class="mb-4">
                <label for="phone" class="block font-semibold text-gray-700">Phone Number</label>
                <input type="text" name="phone" id="phone" class="w-full border p-2 rounded mt-1" value="{{ old('phone') }}" required>
            </div>

            <div class="mb-4">
                <label for="cv_link" class="block font-semibold text-gray-700">CV/Resume Link</label>
                <input type="url" name="cv_link" id="cv_link" class="w-full border p-2 rounded mt-1" value="{{ old('cv_link') }}" required placeholder="https://drive.google.com/file/your-cv">
                <p class="text-sm text-gray-500 mt-1">Please provide a link to your CV/resume (Google Drive, Dropbox, etc.)</p>
            </div>

            <div class="mb-4">
                <label for="cover_letter" class="block font-semibold text-gray-700">Cover Letter</label>
                <textarea name="cover_letter" id="cover_letter" class="w-full border p-2 rounded mt-1" rows="8" required>{{ old('cover_letter') }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Briefly explain why you're interested in this position and why you're a good fit (minimum 50 characters).</p>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('jobs.show', $job->id) }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-200 disabled:opacity-25 transition">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</x-app-layout> 