<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller //controller user extends ke controller laravel
{
    public function show($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) abort(404);

        return view('user.profile', compact('user'));
    }

    public function edit() //fungsi edit
    {
        $user = Auth::user(); //variable user menampung route static pada object user
        return view('user.edit', compact('user')); //mengembalikan view yg berisi parameter user/edit
    }

    public function update(Request $request) //fungsi update berisi parameter request, melakukan authtentikasi, validasi, lalu update arahkan kee home
    {
        $user = Auth::user(); //variable user berisi route auth, object user

        $request->validate([ //cariable request dengan method validate erisi rule ketika akan di update
            'username' => 'required|alpha_dash|min:3|max:15|unique:users,username,' . $user->id, //field suserame require(harus di isi gak boleh kosong, alpha dash karakternya, unique)
            'fullname' => 'max:30', //field fullname menampung 30 karakter
            'bio' => 'max:144', //bio menampung 144 karakter
            'avatar' => 'image|mimes:jpg,jpeg,png' //avatar berisi foto, dengan format jpg, jpeg, png
        ]);

        $imageName = $user->avatar; //variable imagename berisi vvariable user yg memnggi at\uth mengarah ke field avatar
        if ($request->avatar) {  //rules validasi field avatar kondisi pengulanagn true
            $avatar_image = $request->avatar; //foto dengan validasi awal
            $imageName = $user->username . '-' . time() . '-' . $avatar_image->extension(); //imagename dg validasi user digabung waktu saat ini, dan extensi foto
            $avatar_image->move(public_path('images/avatar'), $imageName); //pindahkan foto ke folder public images avatar
        }

        $user->update([ //variable user menuju method update
            'username' => $request->username, //field username mengacu ke variable rquest dengan validate
            'fullname' => $request->fullname,
            'bio' => $request->bio,
            'avatar' => $imageName
        ]);
        return redirect('/home'); //setelah berhasi melewati validasi rule dan cocok dengan request, arahkan ke home
    }

    public function follow($following_id)
    {
        $user = Auth::user();
        if ($user->following->contains($following_id)) {
            $user->following()->detach($following_id);
            $message = ['status' => 'UNFOLLOW'];
        } else {
            $user->following()->attach($following_id);
            $message = ['status' => 'FOLLOW'];
        }
        return response()->json($message);
    }
}
