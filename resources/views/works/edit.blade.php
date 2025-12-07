@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="form-title">Edit Post</h2>

    <form action="{{ route('works.update', $work->id) }}" method="POST" class="post-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Title</label>
            <input 
                type="text" 
                name="title" 
                class="input-field" 
                value="{{ $work->title }}" 
                required
            >
        </div>

        <div class="form-group">
            <label class="form-label">Content</label>
            <textarea 
                name="content"
                class="input-field"
                rows="12"
                required
            >{{ $work->content }}</textarea>
        </div>

        <div class="button-row">
            <a href="{{ route('profile', auth()->id()) }}" class="cancel-btn">Cancel</a>
            <button type="submit" class="publish-btn">Save Changes</button>
        </div>
    </form>
</div>
@endsection
