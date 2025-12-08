@extends('layouts.app')

@section('content')
<div class="reading-view active">

    <a class="back-btn" href="{{ route('reading', $comment->work->slug) }}">← Back</a>

    <div class="modal-content comment-modal" style="max-width:600px;margin:2rem auto;">
        <h2 class="modal-title" style="font-family: 'Crimson Pro', serif;">
            Edit reflection
        </h2>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <textarea 
                name="body" 
                class="comment-textarea"
                required
            >{{ $comment->body }}</textarea>

            <div class="modal-buttons">
                <a href="{{ route('reading', $comment->work->slug) }}" class="cancel-btn">
                    Cancel
                </a>

                <button type="submit" class="submit-btn">
                    Update
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
