<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store(){
        // sirve para cerrar la sesión
        auth()->logout();
        return redirect()->route("login");
    }
    // para que sea mas seguro en controlador en la route/web colocamos el metodo post
}
