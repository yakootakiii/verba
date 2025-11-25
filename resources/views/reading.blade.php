@extends('layouts.app')

@section('content')
<div id="reading-view" class="reading-view active">
    <a class="back-btn" href="{{ route('feed') }}">← Back to Explore</a>
    
    <h1 class="reading-title">On the Weight of Silence</h1>
    <div class="reading-author">by Sarah Chen</div>
    
    <div class="reading-content">
        <p>There are moments when the absence of sound speaks louder than any word could. I learned this during a winter in Vermont, when the snow fell so thick that even the wind held its breath.<span class="annotation-marker"></span></p>
        
        <p>My grandmother had just passed, and I found myself in her cabin, surrounded by the things she'd left behind. Books with dog-eared pages. A kettle that whistled in C sharp. Photographs of people whose names I'd never learned to pronounce.</p>
        
        <p>But what struck me most was the silence. Not the kind that feels empty, but the kind that feels full—dense with everything unsaid, every conversation we postponed, every story she meant to tell me but ran out of time for.<span class="annotation-marker"></span></p>
        
        <p>In that silence, I began to understand that grief isn't just the absence of a person. It's the presence of all the futures that will never happen. The recipes I'll never learn. The advice I'll never receive. The comfort of her hand on my shoulder when life inevitably gets hard again.</p>
        
        <p>Now, years later, I find myself seeking out silence. Not to escape, but to listen. Because in the quiet spaces between words, I sometimes hear her voice again, teaching me what she never had the chance to say aloud: that love doesn't end when sound does. It simply learns a different language.</p>
    </div>

    <!-- Comments Section -->
    <div class="comments-section">
        <div class="comments-header">
            <h3>Reflections</h3>
            <button class="add-comment-btn" onclick="showModal()">Add your thoughts</button>
        </div>

        <div class="comment">
            <div class="comment-header">
                <span class="comment-author">Michael Torres</span>
                <span class="comment-time">2 days ago</span>
            </div>
            <p class="comment-text">The way you describe silence as "full" rather than empty resonates deeply. I lost my father last year, and I've been struggling to articulate this exact feeling. Thank you for putting it into words.</p>
            
            <div class="comment-reply">
                <div class="comment-header">
                    <span class="comment-author">Sarah Chen</span>
                    <span class="comment-time">1 day ago</span>
                </div>
                <p class="comment-text">Thank you, Michael. I'm so sorry for your loss. There's something about grief that makes us all fluent in the same wordless language.</p>
            </div>
        </div>

        <div class="comment">
            <div class="comment-header">
                <span class="comment-author">Priya Sharma</span>
                <span class="comment-time">5 days ago</span>
            </div>
            <p class="comment-text">The image of the kettle that whistled in C sharp—such a specific, tender detail. It's these small observations that make a piece like this feel so honest and lived-in.</p>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal-overlay">
    <div class="modal">
        <h3>Before you share your thoughts</h3>
        <p>We encourage meaningful engagement. Please reflect on these questions:</p>
        
        <div class="modal-question">
            <label>What resonated with you most in this piece?</label>
            <textarea placeholder="Share your reflection..."></textarea>
        </div>

        <div class="modal-question">
            <label>How does this connect to your own experience?</label>
            <textarea placeholder="Share your connection..."></textarea>
        </div>

        <div class="modal-actions">
            <button class="btn-secondary" onclick="hideModal()">Cancel</button>
            <button class="btn-primary" onclick="proceedToComment()">Continue to Comment</button>
        </div>
    </div>
</div>
@endsection
