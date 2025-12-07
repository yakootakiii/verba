@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-header">
        <div class="profile-photo"></div>

        <h1 class="profile-name">{{ $user->name }}</h1>

        <p class="profile-bio">
            {{ $user->bio ?? 'No bio provided yet.' }}
        </p>
    </div>

    <div class="works-list">
        <h3>Published Works</h3>

        @if ($works->isEmpty())
            <p>You haven't published any works yet.</p>
        @else
            @foreach ($works as $work)
                <div 
                    class="work-item" 
                    onclick="window.location='{{ route('reading', $work->slug) }}'"
                >
                    <h4>{{ $work->title }}</h4>

                    <div class="work-date">
                        {{ $work->published_at ? $work->published_at->format('F Y') : 'Unpublished' }}
                    </div>
                </div>

                <div class="divider"></div>
            @endforeach
        @endif
    </div>
</div>
@endsection
