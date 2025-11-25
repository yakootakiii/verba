@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-header">
        <div class="profile-photo"></div>
        <h1 class="profile-name">Sarah Chen</h1>
        <p class="profile-bio">Writer based in New England. Interested in memory, landscape, and the stories we tell ourselves about home. MFA from Iowa Writers' Workshop.</p>
    </div>

    <div class="works-list">
        <h3>Published Works</h3>
        
        <div class="work-item" onclick="window.location='{{ route('reading') }}'">
            <h4>On the Weight of Silence</h4>
            <div class="work-date">March 2025</div>
        </div>

        <div class="divider"></div>

        <div class="work-item">
            <h4>Instructions for Leaving</h4>
            <div class="work-date">February 2025</div>
        </div>

        <div class="divider"></div>

        <div class="work-item">
            <h4>What the Mountains Remember</h4>
            <div class="work-date">January 2025</div>
        </div>
    </div>
</div>
@endsection
