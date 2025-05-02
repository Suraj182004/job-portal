<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $recentJobs = Job::latest()->take(5)->get();
    $filters = request()->only(['search', 'location', 'type']);
    return view('welcome', compact('recentJobs', 'filters'));
})->name('home');

Route::get('/dashboard', function () {
    $user = Auth::user();

    // Fetch jobs posted by the user
    $postedJobs = $user->jobs()->latest()->paginate(5, ['*'], 'posted');

    // Fetch applications submitted by the user, with job details
    $applications = $user->jobApplications()->with('job')->latest()->paginate(5, ['*'], 'applied');

    return view('dashboard', compact('postedJobs', 'applications'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Job management
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    
    // Application management
    Route::get('/jobs/{job}/apply', [JobApplicationController::class, 'create'])->name('jobs.apply.form');
    Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/jobs/{job}/applications', [JobApplicationController::class, 'index'])->name('jobs.applications');
    Route::get('/applications/my', [JobApplicationController::class, 'myApplications'])->name('my.applications');
    
    // Job viewing - require authentication
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
});

require __DIR__.'/auth.php';
