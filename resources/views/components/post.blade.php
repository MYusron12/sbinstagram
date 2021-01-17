{{-- postingan --}}
<div class="card mb-3">
    <div class="container">
        <a href="/{{ '@' . $post->user->username }}">{{ '@' . $post->user->username }}</a>
    </div>
    <img src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->caption }}" width="100%" height="auto"
        ondblclick="like({{ $post->id }})" />
    <h5 class="card-title"></h5>
    <div class="container">
        <p class="card-text captions">Caption :
            <strong>
                {{ $post->caption }}
            </strong>
        </p>
    </div>
    <div class="container d-inline">
        <span class="total_count" id="post-likescount-{{ $post->id }}">{{ $post->likes_count }}</span>
        <a class="text-dark" onclick="like({{ $post->id }})" id="post-btn-{{ $post->id }}">
            {{ $post->is_liked() ? 'unlike' : 'like' }}
        </a> -
        <a class="text-dark" href="/post/{{ $post->id }}">komentar</a> -
        <small>{{ $post->created_at->diffForHumans() }}</small>
    </div>
</div>
