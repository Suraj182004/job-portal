<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class JobApplicationController extends Controller
{
    /**
     * Show the form to apply for a job
     */
    public function create(Job $job)
    {
        // User should be authenticated to apply
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Prevent user from applying to their own job
        if ($job->user_id === Auth::id()) {
            return redirect()->route('jobs.show', $job->id)->with('error', 'You cannot apply to your own job posting.');
        }

        // Check if user has already applied
        $hasApplied = Auth::user()->jobApplications()->where('job_id', $job->id)->exists();
        if ($hasApplied) {
            return redirect()->route('jobs.show', $job->id)->with('error', 'You have already applied for this job.');
        }

        return view('applications.create', compact('job'));
    }

    /**
     * Store a newly created job application in storage.
     */
    public function store(Request $request, Job $job)
    {
        $user = Auth::user();

        // Prevent user from applying to their own job
        if ($job->user_id === $user->id) {
            return back()->with('error', 'You cannot apply to your own job posting.');
        }

        // Validate the request
        $request->validate([
            'cover_letter' => 'required|string|min:50',
            'cv_link' => 'required|url',
            'phone' => 'required|string|max:20',
        ]);

        try {
            // Create the application
            JobApplication::create([
                'user_id' => $user->id,
                'job_id' => $job->id,
                'cover_letter' => $request->cover_letter,
                'cv_link' => $request->cv_link,
                'phone' => $request->phone,
            ]);

            return redirect()->route('jobs.show', $job->id)->with('success', 'Application submitted successfully!');

        } catch (QueryException $e) {
            // Check if the error is due to the unique constraint violation
            if ($e->errorInfo[1] == 1062 || str_contains($e->getMessage(), 'Duplicate entry')) {
                return back()->with('error', 'You have already applied for this job.');
            }
            // Re-throw other database errors
            throw $e;
        }
    }

    /**
     * List all applications for a job (for the job poster)
     */
    public function index(Job $job)
    {
        // Ensure user can only view applications for their own jobs
        if ($job->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $applications = $job->applications()->with('user')->latest()->paginate(10);
        return view('applications.index', compact('job', 'applications'));
    }

    /**
     * Show my applications (for applicants)
     */
    public function myApplications()
    {
        $applications = Auth::user()->jobApplications()->with('job')->latest()->paginate(10);
        return view('applications.my-applications', compact('applications'));
    }
}
