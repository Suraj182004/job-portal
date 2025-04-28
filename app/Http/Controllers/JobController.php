<?php

namespace App\Http\Controllers;
use App\Models\Job;

use Illuminate\Http\Request;

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

    public function index()
    {
        $jobs = Job::paginate(10); // Display 10 jobs per page
        return view('jobs.index', compact('jobs'));
    }
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }
}
