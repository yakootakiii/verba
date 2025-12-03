@extends('layouts.app')

@section('content')
<div id="reading-view" class="reading-view active">
    <a class="back-btn" href="{{ route('feed') }}">← Back to Explore</a>

    @isset($work)
        <h1 class="reading-title">{{ $work->title }}</h1>
        <div class="reading-author">by {{ $work->author->name }}</div>
        <div class="reading-content">
            {!! nl2br(e($work->content)) !!}
        </div>
        <!-- Comments -->
        <div class="comments-section">
            <div class="comments-header">
                <h3>Reflections</h3>
                @auth
                    <button class="add-comment-btn" onclick="showModal()">Add your thoughts</button>
                @else
                    <p><a href="{{ route('login') }}">Sign in</a> to comment</p>
                @endauth
            </div>
            @foreach ($work->comments as $comment)
                <div class="comment">
                    <div class="comment-header">
                        <span class="comment-author">{{ $comment->user->name }}</span>
                        <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="comment-text">{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-work-message" style="text-align:center; margin:40px auto; color:#888; font-size:1.2em;">
            No work selected.
        </div>
    @endisset
</div>
@endsection
