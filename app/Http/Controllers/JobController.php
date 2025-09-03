<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class JobController extends Controller
{
public function index()
{
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
    'jobs' => $jobs
    ]);
}

public function create()
{
    return view('jobs.create');
}

public function show(Job $job)
{
    return view('jobs.show', ['job' => $job]);
}

public function store()
{
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required', 'regex:/.*\d.*/']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' =>1
    ]);
    return redirect('/jobs');
}

public function edit(Job $job)
{
    Gate::define('edit-job', function (User $user, Job $job) {
    return $job->employer->user->is($user);
    });

    if (Auth::guest()) {
        return redirect('/login');
    }

    Gate::authorize('edit-job', $job);

    return view('jobs.edit', ['job' => $job]);
}

public function update(Job $job)
{
// Validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required', 'regex:/.*\d.*/']
    ]);
// Authorize(on hold...
// Update the Job
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
// and persist
// redirect to the job page
    return redirect('/jobs/' . $job->id);
}

public function destroy(Job $job)
{
// Delete the Job
    $job->delete();
    return redirect('/jobs');
}
}