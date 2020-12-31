@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Comment Caption</div>
        <div class="card-body">
          <x-post :post="$post" />
        <form method="POST" action="/post/{{$post->id}}/comment">
            @csrf

            <x-textarea name="body" label="komentar kamu"/>
            <x-submitbtn text="post komment" />

          </form>
          @foreach ($post->comments as $comment)
              <p>
                <a href="{{'@'.$comment->user->username}}">{{'@'.$comment->user->username}}</a> : {{$comment->body}}
                @if (Auth::user()->id == $comment->user->id)
                | <a href="/comment/{{$comment->id}}/edit">Edit</a>
                | <a onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Hapus</a>

             <form id="delete-form" action="/comment/{{$comment->id}}" method="POST" class="d-none">
                 @csrf
                 @method('DELETE')
             </form>
                @endif
              </p>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('js/feed.js')}}"></script>
@endsection