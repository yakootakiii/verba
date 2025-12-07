<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WriterApplication;
use App\Models\User;

class WriterApplicationController extends Controller
{
    public function index()
    {
        $applications = WriterApplication::with('reader')
            ->latest()
            ->get();

        return view('admin.writer_applications', compact('applications'));
    }

    public function approve($id)
    {
        $application = WriterApplication::findOrFail($id);

        $application->update(['status' => 'approved']);

        $application->user->update(['role' => 'writer']);

        return back()->with('success', 'User approved as writer.');
    }

    public function reject($id)
    {
        $application = WriterApplication::findOrFail($id);

        $application->update(['status' => 'rejected']);

        return back()->with('error', 'Application rejected.');
    }
}
