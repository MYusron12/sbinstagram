@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Comment Caption</div>
        <div class="card-body">
          <x-post :post="$post" />
        <form method="POST" action="/comment/{{$post->id}}">
            @csrf

            <x-textarea name="body" label="komentar kamu"/>
            <x-submitbtn text="post komment" />

          </form>
          @foreach ($post->comments as $comment)
              <p><a href="{{'@'.$comment->user->username}}">{{'@'.$comment->user->username}}</a> : {{$comment->body}}</p>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('js/feed.js')}}"></script>
@endsection