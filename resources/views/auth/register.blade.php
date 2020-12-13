@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <x-input label="Username" name="username" />
                        <x-input label="Email" name="email" type="email" />
                        <x-input label="Password" name="password" type="password" />
                        <x-input label="Ulang Password" name="password_confirmation" type="password" />
                        <x-submitbtn text="Daftar" />

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection