<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user(); //variable user berisi route auth, object user

        $request->validate([ //cariable request dengan method validate erisi rule ketika akan di update
            'caption' => 'max:250', //bio menampung 144 karakter
            'image' => 'required|image|mimes:jpg,jpeg,png' //avatar berisi foto, dengan format jpg, jpeg, png
        ]);

        $imageName = $user->image; //variable imagename berisi vvariable user yg memnggi at\uth mengarah ke field image
        if ($request->image) {  //rules validasi field image kondisi pengulanagn true
            $image_image = $request->image; //foto dengan validasi awal
            $imageName = $user->username . '-' . time() . '-' . $image_image->extension(); //imagename dg validasi user digabung waktu saat ini, dan extensi foto
            $image_image->move(public_path('images/posts'), $imageName); //pindahkan foto ke folder public images image
        }

        $user->posts()->create([ //variable user menuju method update
            'caption' => $request->caption,
            'image' => $imageName
        ]);
        return redirect('/home'); //setelah berhasi melewati validasi rule dan cocok dengan request, arahkan ke home
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->load('comments.user')->loadCount('likes');
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::user()->id)
            abort(403);

        $request->validate([ //cariable request dengan method validate erisi rule ketika akan di update
            'caption' => 'max:250', //bio menampung 144 karakter
        ]);

        $post->update([ //variable user menuju method update
            'caption' => $request->caption,
        ]);
        return redirect('/home'); //setelah berhasi melewati validasi rule dan cocok dengan request, arahkan ke home
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
