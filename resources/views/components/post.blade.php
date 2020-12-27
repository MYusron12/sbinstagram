{{-- postingan --}}
<div class="card mb-3" style="max-width: 18rem;">
  <div class="card-header">
      <a href="/{{'@'.$post->user->username}}">{{'@'.$post->user->username}}</a>
  </div>
  <div class="card-body">
          <img src="{{asset('images/posts/' . $post->image)}}" alt="{{$post->caption}}" width="200px" height="200px" ondblclick="like({{$post->id}})"/>
    <h5 class="card-title"></h5>
    <p class="card-text captions">Caption : 
        <strong>
            {{$post->caption}}
      </strong> 
    </p>
    <button class="btn btn-primary" onclick="like({{$post->id}})" id="post-btn-{{$post->id}}">
        {{ ($post->is_liked() ? 'unlike' : 'like' ) }}
    </button>

    <a href="/post/{{$post->id}}">komentar</a>
  </div>
</div>