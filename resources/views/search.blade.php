@extends('layouts.app')

@section('content')
<div class="container">
    <div class="feed-list">
        {{-- Search Bar --}}
        <form action="{{ route('search') }}" method="GET" class="search-bar-wrapper" style="margin-bottom: 25px;">
            <input 
                type="text" 
                name="q" 
                class="search-input input-field" 
                placeholder="Search articles, authors, or topics..."
                value="{{ request('q') }}"
            >
        </form>

        {{-- Filter Section --}}
        <div class="filter-wrapper" style="margin-bottom: 25px;">
            <form action="{{ route('search') }}" method="GET" class="filter-form" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <input type="hidden" name="q" value="{{ request('q') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <label for="sort" class="form-label" style="margin-bottom: 0;">Sort by:</label>
                <select 
                    name="sort" 
                    id="sort"
                    onchange="this.form.submit()"
                    class="input-field"
                    style="width: auto; min-width: 120px; margin-bottom: 0;"
                >
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
            </form>
        </div>

        {{-- Optional: Show Search Results Count --}}
        @if(isset($results))
            <p style="color: #777; margin-bottom: 20px;">
                Showing {{ $results->count() }} results
            </p>
        @endif

        {{-- Search Results --}}
        @if(isset($results))
            @forelse($results as $work)
                <article class="piece" onclick="window.location='{{ route('reading', $work->slug) }}'">
                    <div class="piece-meta">
                        {{ $work->author->name ?? '' }} · 
                        {{ $work->published_at ? $work->published_at->format('F Y') : 'Unpublished' }}
                    </div>
                    <h2>{{ $work->title }}</h2>
                    <p class="piece-excerpt">
                        {{ Str::limit(strip_tags($work->content ?? $work->excerpt), 120) }}
                    </p>
                </article>
                <div class="divider"></div>
            @empty
                <p class="no-posts">No results found.</p>
            @endforelse
        @endif
    </div>
</div>
@endsection
