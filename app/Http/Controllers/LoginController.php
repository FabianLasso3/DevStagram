<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view("auth.login");
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // autenticar el usuario que ya fue registrado en el sistema
        // y si los datos ingresados son correctos
        // el request-remember para que recuerde el email y la clave y amntenga  la seision activa eso va a crear una cooki
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            // aqui creamos un mensaje que se va a mostrar en otro archivo x mensaje es el nombre que le pusimos >with('mensaje'
            // con back puedes volver a la pagina anterior
            return back()->with('mensaje','Credenciales incorrectas');
        }
        
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
