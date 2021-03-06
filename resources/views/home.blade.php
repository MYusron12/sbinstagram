@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Clone Mini Instagram</div>

                    <div class="container">
                        <h3>Postingan</h3>
                        @forelse($posts as $post)
                            <x-post :post="$post" />
                        @empty
                            <p>Data berupa @isset($querySearch)
                                    {{ $querySearch }}, tidak ada
                                @endisset
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/feed.js') }}"></script>
@endsection
