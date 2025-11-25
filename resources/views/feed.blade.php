@extends('layouts.app')

@section('content')
<div class="container">
    <div class="feed-list">
        <article class="piece" onclick="window.location='{{ route('reading') }}'">
            <div class="piece-meta">Sarah Chen · March 2025</div>
            <h2>On the Weight of Silence</h2>
            <p class="piece-excerpt">There are moments when the absence of sound speaks louder than any word could...</p>
        </article>

        <div class="divider"></div>

        <article class="piece">
            <div class="piece-meta">Marcus Webb · March 2025</div>
            <h2>Letters to My Younger Self</h2>
            <p class="piece-excerpt">If I could write to the boy I was at seventeen...</p>
        </article>

        <div class="divider"></div>

        <article class="piece">
            <div class="piece-meta">Elena Rossi · February 2025</div>
            <h2>The Grammar of Loss</h2>
            <p class="piece-excerpt">My mother spoke three languages fluently...</p>
        </article>
    </div>
</div>
@endsection
