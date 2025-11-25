@extends('layouts.app')

@section('content')
<section class="hero">
    <h1>A quiet space for words that matter</h1>
    <p>Where thoughtful writing meets engaged reading</p>
    <a href="{{ route('feed') }}" class="btn-primary">Join as Writer</a>
</section>
@endsection
