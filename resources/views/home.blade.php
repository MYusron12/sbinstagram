@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h3>Postingan</h3>
                    @forelse($posts as $post)
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
                        </div>
                      </div>
                      <script>
document.querySelectorAll(".captions").forEach(function(el){
    let renderedText = el.innerHTML.replace(/#(\w+)/g, "<a href='/search?query=%23$1'>#$1</a>");
    el.innerHTML = renderedText
})

                          function like(id){
                              const el = document.getElementById('post-btn-' + id)
                              fetch('/like/' + id)
                              .then(Response => Response.json())
                              .then(data => {
                                  el.innerText = (data.status == 'LIKE') ? 'unlike' : 'like'
                              });
                          }
                      </script>

                    <div class="mt2">
                    </div>
                    @empty
                    <p>Data berupa @isset($querySearch)
                        {{$querySearch}}, tidak ada
                    @endisset </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection