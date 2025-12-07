@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-header">
        <div class="profile-photo"></div>

        <h1 class="profile-name">{{ $user->name }}</h1>

        <p class="profile-bio">
            {{ $user->bio ?? 'No bio provided yet.' }}
        </p>

        <!-- Create New Post Button -->
        @if (auth()->check() && in_array(auth()->user()->role, ['writer', 'admin']))
            <a href="{{ route('works.create') }}" class="btn btn-primary mt-3">
                Create New Post
            </a>
        @endif

        <!-- Edit Profile Button -->
        @if (auth()->id() === $user->id)
            <button class="btn btn-secondary mt-2" onclick="openProfileModal()">
                Edit Profile
            </button>
        @endif
    </div>

    <div class="works-list mt-4">
        <h3>Published Works</h3>

        @if ($works->isEmpty())
            <p>You haven't published any works yet.</p>
        @else
            @foreach ($works as $work)
                <div class="work-item" onclick="window.location='{{ route('reading', $work->slug) }}'">
                    <h4>{{ $work->title }}</h4>

                    <div class="work-date">
                        {{ $work->published_at ? $work->published_at->format('F Y') : 'Unpublished' }}
                    </div>
                </div>

                <!-- Edit + Delete Buttons (only for the owner) -->
                @if (auth()->id() === $work->author_id)
                    <div class="profile-actions">

                        <!-- EDIT BUTTON -->
                        <a href="{{ route('works.edit', $work->id) }}" class="edit-btn">Edit</a>

                        <!-- DELETE BUTTON -->
                        <button class="delete-btn" onclick="openDeleteModal({{ $work->id }})">
                            Delete
                        </button>

                        <!-- Hidden Delete Form -->
                        <form id="delete-form-{{ $work->id }}" 
                            action="{{ route('works.destroy', $work->id) }}" 
                            method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endif

                <div class="divider"></div>
            @endforeach
        @endif
    </div>

    <!-- APPLY AS WRITER BUTTON (only for readers) -->
    @if(auth()->check() && auth()->user()->role === 'reader')
        <div class="apply-writer mt-5 text-center">
            <button class="btn btn-primary" onclick="openWriterModal()">Become a Writer</button>
        </div>

        <!-- WRITER APPLICATION MODAL -->
        <div id="writer-modal" class="modal-overlay hidden">
            <div class="modal-box">
                <h3 class="modal-title">Apply to Become a Writer</h3>
                <p>Tell us why you want to become a writer. Your application will be sent to the admin for approval.</p>

                <form action="{{ route('writer.apply') }}" method="POST">
                    @csrf
                    <label for="reason">Reason</label>
                    <textarea name="reason" id="reason" rows="4" class="modal-textarea" required></textarea>

                    <div class="modal-buttons mt-3">
                        <button type="button" class="modal-cancel" onclick="closeWriterModal()">Cancel</button>
                        <button type="submit" class="modal-confirm">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>

<!-- DELETE CONFIRMATION MODAL -->
<div id="delete-modal" class="modal-overlay hidden">
    <div class="modal-box">
        <h3 class="modal-title">Delete This Post?</h3>
        <p class="modal-text">Are you sure you want to delete this post? This action cannot be undone.</p>

        <div class="modal-buttons">
            <button class="modal-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button class="modal-confirm" id="modal-confirm-delete">Delete</button>
        </div>
    </div>
</div>

<!-- EDIT PROFILE MODAL -->
<div id="profile-modal" class="modal-overlay hidden">
    <div class="modal-box">
        <h3 class="modal-title">Edit Profile</h3>

        <form id="profile-form" method="POST" action="{{ route('profile.update', $user->id) }}">
            @csrf
            @method('PUT')

            <label>Name</label>
            <input type="text" name="name" class="modal-input" value="{{ $user->name }}" required>

            <label>Bio</label>
            <textarea name="bio" class="modal-textarea" rows="4">{{ $user->bio }}</textarea>

            <label>Password (required to confirm changes)</label>
            <input type="password" name="password" class="modal-input" required>

            <div class="modal-buttons">
                <button type="button" class="modal-cancel" onclick="closeProfileModal()">Cancel</button>
                <button type="submit" class="modal-confirm">Save Changes</button>
            </div>
        </form>
    </div>
</div>

@endsection
