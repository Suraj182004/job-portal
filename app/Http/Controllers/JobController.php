<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    //
    public function create()
    {
        return view('jobs.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'location'=>'required',
            'type'=>'required',
            'salary'=>'nullable|numeric',
        ]);

        Job::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'type' => $request->type,
            'salary' => $request->salary,
        ]);
        return redirect('/')->with('success', 'Job posted successfully!');
    }

    // Display a list of jobs with filtering and searching
    public function index(Request $request)
    {
        $query = Job::query()->with('user'); // Eager load user to potentially show poster name

        // Search filter (searches title and description)
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        // Type filter
        if ($request->filled('type') && $request->input('type') !== 'all') {
            $query->where('type', $request->input('type'));
        }

        // Get filtered and paginated jobs, ordered by latest first
        $jobs = $query->latest()->paginate(10)->withQueryString(); // Append query string to pagination links

        // Initialize filters with default values if they don't exist
        $filters = $request->only(['search', 'location', 'type']);
        
        // Set default values for any missing filters
        $filters['search'] = $filters['search'] ?? '';
        $filters['location'] = $filters['location'] ?? '';
        $filters['type'] = $filters['type'] ?? 'all';

        return view('jobs.index', [
            'jobs' => $jobs,
            'filters' => $filters
        ]);
    }
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    // Method to show the edit form
    public function edit(Job $job)
    {
        // Authorize: Only allow the user who created the job to edit it
        Gate::authorize('update', $job);

        return view('jobs.edit', compact('job'));
    }

    // Method to update the job
    public function update(Request $request, Job $job)
    {
        // Authorize: Only allow the user who created the job to update it
        Gate::authorize('update', $job);

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'location'=>'required',
            'type'=>'required',
            'salary'=>'nullable|numeric',
        ]);

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'type' => $request->type,
            'salary' => $request->salary,
        ]);

        return redirect()->route('jobs.show', $job->id)->with('success', 'Job updated successfully!');
    }

    // Method to delete the job
    public function destroy(Job $job)
    {
        // Authorize: Only allow the user who created the job to delete it
        Gate::authorize('delete', $job);

        $job->delete();

        // Redirect to the job index page with a success message
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
