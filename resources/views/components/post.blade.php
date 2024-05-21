@props(['post'])

<div class="content">
    <div class="post_owner">
        <img src="{{ asset('assets/images/default.jfif') }}" width="60px" height="60px" alt="">
        <div>
            <p>{{ $post->user->name }}</p>
            <p>{{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>
    <div class="post_caption">
        <p>{{ $post->caption }}</p>
        <div class="gallery">
            @php
                $contentArray = json_decode($post->content, true);
                $liked = false;
            @endphp
            <div class="main-container">
                @foreach ($contentArray as $index => $item)
                    @if ($item['type'] === 'image')
                        <img src="{{ asset('uploads/' . $item['path']) }}" alt=""
                            id="main-image-{{ $post->id }}" class="main">
                    @else
                        <video width="100%" controls>
                            <source src="{{ asset('uploads/' . $item['path']) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                @break
            @endforeach
        </div>
        <div class="thumbnails">
            @foreach ($contentArray as $index => $item)
                <img src="{{ asset('uploads/' . $item['path']) }}" alt="" class="sub"
                    onclick="changeMainImage(this, 'main-image-{{ $post->id }}')">
            @endforeach
        </div>
    </div>
</div>

<div class="post_interaction">
    <button class="like_button {{ $liked ? 'liked' : '' }}" onclick="toggleLike(this)">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                fill="currentColor" />
        </svg>
    </button>
</div>

<div class="comments_section" id="comments_section">
    <div class="comments_container">
        @foreach ($post->comments as $comment)
            <div class="comment">
                <img src="{{ asset('assets/images/default.jfif') }}" width="40px" height="40px" alt=""
                    class="comment_profile">
                <p><strong>{{ $comment['user']['name'] }}</strong> {{ $comment['comment'] }}</p>
            </div>
        @endforeach
    </div>
    <form id="comment-form">
        <div>
            <textarea class="comment-input" name="comment-input" placeholder="Add a comment..." style="width: 90%;height:4rem"></textarea>
        </div>
        <input type="hidden" name="post_id" class="post_id" value="{{ $post->id }}" id="">
        <button>Comment</button>
    </form>
</div>
</div>
<script>
    // add comments
    $('document').ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#comment-form').on('submit', function(e) {
            e.preventDefault();

            var comment = $('.comment-input').val();
            var postId = $('.post_id').val();

            $.ajax({
                url: "/comments",
                type: 'POST',
                data: {
                    comment: comment,
                    post_id: postId
                },
                // contentType: false,
                // processData: false,
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#comments_section')[0].reset();
                    }
                },
                error: function(xhr) {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>
{{ $script ?? '' }}
