<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:2000',
        ]);

        // Prevent duplicate pending applications
        $existing = WriterApplication::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have a pending application.');
        }

        WriterApplication::create([
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your application has been submitted to the admin.');
    }
}
