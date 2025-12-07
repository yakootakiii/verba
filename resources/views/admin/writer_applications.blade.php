@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="font-family: 'Crimson Pro', serif; font-size: 2rem; font-weight: 600; margin-bottom: 2.5rem;">Writer Applications</h2>

    @forelse ($applications as $app)
        <div style="background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); padding: 2rem 2rem 1.5rem 2rem; margin-bottom: 2rem; border: 1px solid #e8e6e1;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <strong style="font-size: 1.1rem; font-family: 'Inter', sans-serif;">{{ $app->user->name }}</strong>
                <span style="font-size: 0.95rem; color: #888; background: #f4f4f4; border-radius: 6px; padding: 4px 12px;">Status: {{ ucfirst($app->status) }}</span>
            </div>
            <div style="margin-bottom: 1.2rem; color: #444; font-size: 1rem; font-family: 'Inter', sans-serif;">
                <span style="font-weight: 600; color: #2b2b2b;">Reason:</span> {{ $app->reason }}
            </div>
            @if($app->status === 'pending')
                <div style="display: flex; gap: 1rem;">
                    <form action="{{ route('admin.writer.approve', $app->id) }}" method="POST">
                        @csrf
                        <button class="btn publish-btn" type="submit">Approve</button>
                    </form>
                    <form action="{{ route('admin.writer.reject', $app->id) }}" method="POST">
                        @csrf
                        <button class="btn delete-btn" type="submit">Reject</button>
                    </form>
                </div>
            @endif
        </div>
    @empty
        <p class="no-posts">No writer applications yet.</p>
    @endforelse
</div>
@endsection
