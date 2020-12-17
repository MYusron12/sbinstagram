@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h3>Postingan</h3>
                    @foreach($posts as $post)
                    <div class="mt-5">
                        <img src="{{asset('images/posts/' . $post->image)}}" alt="{{$post->caption}}" width="200px" height="200px"/>
                    </div>
<div class="mt-3">
                    {{-- link ke username / profile --}}
                    <a href="/{{'@'.$post->user->username}}">{{'@'.$post->user->username}}</a>
                    
                    {{-- button like/unlike --}}
                    <button class="btn btn-primary" onclick="like({{$post->id}}, this)">
                        {{ ($post->is_liked() ? 'unlike' : 'like' ) }}
                    </button>
                </div>
                      <script>
                          function like(id, el){
                              fetch('/like/' + id)
                              .then(Response => Response.json())
                              .then(data => {
                                  el.innerText = (data.status == 'LIKE') ? 'unlike' : 'like'
                              });
                          }
                      </script>

                    <div class="mt2">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection