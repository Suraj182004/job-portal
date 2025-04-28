<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Post a New Job</h1>

        <form method="POST" action="{{ route('jobs.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold">Title</label>
                <input type="text" name="title" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Description</label>
                <textarea name="description" class="w-full border p-2" rows="5" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Location</label>
                <input type="text" name="location" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Type</label>
                <select name="type" class="w-full border p-2" required>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Internship">Internship</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Salary</label>
                <input type="number" name="salary" class="w-full border p-2">
            </div>

        <button type="submit" style="background-color: #3182ce; color: white; padding: 10px 20px; border-radius: 5px; border: none;">
    Post Job
</button>


        </form>
    </div>
</x-app-layout>
