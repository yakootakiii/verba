@extends('layouts.app')

@section('content')
<div class="reading-view active">
    <a class="back-btn" href="{{ route('feed') }}">← Back to Explore</a>

    @isset($work)
        <h1 class="reading-title">{{ $work->title }}</h1>
        <div class="reading-author">by {{ $work->author->name }}</div>
        <div class="reading-content">
            {!! nl2br(e($work->content)) !!}
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <div class="comments-header">
                <h3>Reflections</h3>
            </div>

            @if($work->comments->isEmpty())
                <p class="no-comments">No reflections yet. Be the first to share your thoughts!</p>
            @endif

            @foreach ($work->comments as $comment)
                <div class="comment-block">
                    <div class="comment-left-border"></div>
                    <div class="comment-body">
                        <div class="comment-header">
                            <div class="comment-header-left">
                                <span class="comment-author">{{ $comment->user->name }}</span>
                                <span class="comment-dot">•</span>
                                <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>

                            @auth
                                @if($comment->user_id === auth()->id())
                                    <div class="comment-menu-wrapper">
                                        <button type="button" class="comment-menu-btn" onclick="toggleCommentMenu(this)">
                                            <span class="comment-menu-icon">&#8942;</span>
                                        </button>
                                        <div class="comment-menu-dropdown hidden">

                                            <!-- Edit button -->
                                            <a href="{{ route('comments.edit', $comment->id) }}" class="comment-menu-edit">
                                                Edit
                                            </a>

                                            <!-- Delete button -->
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this comment?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="comment-menu-delete">Delete</button>
                                            </form>

                                        </div>  

                                    </div>
                                @endif
                            @endauth
                        </div>
                        <div class="comment-text">
                            {{ $comment->body }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- COMMENT MODAL -->
        <div id="modal" class="modal hidden">
            <div class="modal-content comment-modal">
                <h2 class="modal-title" style="font-family: 'Crimson Pro', serif; font-size: 1.5rem; font-weight: 600;">Add a reflection</h2>
                <form action="{{ route('comments.store', $work->id) }}" method="POST">
                    @csrf
                    <textarea 
                        name="body" 
                        class="comment-textarea" 
                        @guest disabled @endguest
                        @auth required @endauth
                        placeholder="What are your thoughts?"
                    >
                    </textarea>

                    <div class="modal-buttons">

                        @auth
                            <button type="submit" class="submit-btn">Post</button>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="submit-btn">
                                Sign in to add reflection
                            </a>
                        @endguest
                    </div>

                </form>
            </div>
        </div>
    @else
        <div class="no-work-message">
            No work selected.
        </div>
    @endisset
</div>

<script>
function toggleCommentMenu(btn) {
    const dropdown = btn.parentElement.querySelector('.comment-menu-dropdown');
    document.querySelectorAll('.comment-menu-dropdown').forEach(el => {
        if (el !== dropdown) el.classList.add('hidden');
    });
    dropdown.classList.toggle('hidden');
    document.addEventListener('click', function handler(e) {
        if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
            document.removeEventListener('click', handler);
        }
    });
}
</script>
@endsection
