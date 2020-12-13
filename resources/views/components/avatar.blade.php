@php
$avatar_url = ($user->avatar)
? asset('images/avatar/' . $user->avatar)
: "https://ui-avatars.com/api/?size128&name=" . $user->username;
@endphp

<img src="{{$avatar_url}}" alt="foto {{$user->username}}" width="120" height="120" class="rounded-circle">