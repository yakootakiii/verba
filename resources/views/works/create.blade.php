@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="form-title">Create New Post</h2>

    <form action="{{ route('works.store') }}" method="POST" class="post-form">
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">Title</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                class="input-field"
                required
            >
        </div>

        <div class="form-group">
            <label for="content" class="form-label">Content</label>
            <textarea 
                name="content" 
                id="content" 
                rows="12" 
                class="input-field"
                required
            ></textarea>
        </div>

        <input type="hidden" name="published_at" value="{{ now() }}">

        <div class="button-row">
            <a href="{{ url()->previous() }}" class="cancel-btn">Cancel</a>
            <button type="submit" class="publish-btn">Publish</button>
        </div>
    </form>
</div>
@endsection
