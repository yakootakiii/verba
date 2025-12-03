@extends('layouts.app')

@section('content')
<div class="container">
    <div class="feed-list">
        @if ($works->isEmpty())
            <p class="no-posts">No posts yet</p>
        @else
            @foreach ($works as $work)
                <article class="piece" onclick="window.location='{{ route('reading', $work->slug) }}'">
                    <div class="piece-meta">
                        {{ $work->author->name }} · 
                        {{ $work->published_at ? $work->published_at->format('F Y') : 'Unpublished' }}
                    </div>

                    <h2>{{ $work->title }}</h2>

                    <p class="piece-excerpt">
                        {{ Str::limit(strip_tags($work->content), 120) }}
                    </p>
                </article>

                <div class="divider"></div>
            @endforeach
        @endif
    </div>
</div>
@endsection
