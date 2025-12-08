<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment for a work.
     */
    public function store(Request $request, $id)
    {
        // Validate the comment
        $validated = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        // Make sure the work exists
        $work = Work::findOrFail($id);

        // Create the comment
        Comment::create([
            'work_id' => $work->id,
            'user_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        return redirect()
            ->route('reading', $work->slug)
            ->with('success', 'Your thought has been added!');
    }

    /**
     * Delete a comment (optional)
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Only allow the owner or an admin to delete
        if ($comment->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }

    /**
     * Show the edit comment form
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        // Only allow the owner (or admin) to edit
        if ($comment->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the comment
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        // Only allow the owner (or admin) to update
        if ($comment->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Validate
        $validated = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        // Update
        $comment->update([
            'body' => $validated['body']
        ]);

        return redirect()
            ->route('reading', $comment->work->slug)
            ->with('success', 'Comment updated successfully.');
    }

}
