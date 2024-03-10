<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //el user es el perfil que estamos visitando
    public function store(User $user){
        //usar attach cuando tengas una relacion e muchos a muchos o cuando relacionas con la misma tabla
        $user->followers()->attach( auth()->user()->id );
        return back();
    }

    public function destroy(User $user){
        //para quiar el seguirdor
        $user->followers()->detach( auth()->user()->id );
        return back();
    }
}
