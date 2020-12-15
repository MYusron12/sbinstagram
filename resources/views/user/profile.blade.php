@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>{{'@'.$user->username}}</h1></div>

                <div class="card-body">
                    <x-avatar :user="$user" />
                    
                    <h2>Fullname : {{$user->fullname}}</h2>
                    <h4>Biodata : {{$user->bio}}</h4>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <br>
                    @if (Auth::user()->id == $user->id)
                        <a class="btn btn-primary" href="/user/edit">Edit Profile</a>
                        @else
                        <button class="btn btn-primary" onclick="follow({{$user->id}}, this)">
                          {{ (Auth::user()->following->contains($user->id) ? 'unfollow' : 'follow' ) }}
                        </button>
                        @endif
                        <script>
                            function follow(id, el){
                                fetch('/follow/' + id)
                                .then(Response => Response.json())
                                .then(data => {
                                    el.innerText = (data.status == 'FOLLOW') ? 'unfollow' : 'follow'
                                });
                            }
                        </script>
                        <br>
                    <h3>Postingan</h3>
                    @foreach($user->posts as $post)
                    <li>
                        <img src="{{asset('images/posts/' . $post->image)}}" alt="{{$post->caption}}" width="200px" height="200px"/>
                      @if (Auth::user()->id == $user->id)
                      <a href="/post/{{$post->id}}/edit">Edit</a>
                      @endif
                    </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection