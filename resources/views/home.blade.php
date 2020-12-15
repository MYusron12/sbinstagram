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
                    <a href="/{{'@'.$post->user->username}}">{{'@'.$post->user->username}}</a>
                    <div class="mt2">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection