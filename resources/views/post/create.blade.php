@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Upload Foto</div>
        <div class="card-body">
          <form method="POST" action="/post" enctype="multipart/form-data">
            @csrf

            <x-fileupload name="image" />
            <x-textarea name="caption" label="caption kamu" />
            <x-submitbtn text="post" />

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection