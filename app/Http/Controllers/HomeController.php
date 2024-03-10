<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        // Para que el home solo lo puedan ver usuarios autenticados 
        $this->middleware('auth');
    }

    //si solo hay un metodo se puede usar invoke, se va a ejecutar solo 
    public function __invoke(){
        //pluck va a traer solo ciertos campos 
        //obtener aquien seguimos 
        $ids = auth()->user()->followings->pluck('id')->toArray();
        //obtener los posts
        //latest va ordenar todo para aparezca el ultimo post primero
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
