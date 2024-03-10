<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){ 
        //imprime y detiene la ejecucion
        // dd($request); acceder a todos los valores que se enviaron
        // acceder aun solo dato
        // dd($request->get('username'));
        
        $request->request->add(['username' => Str::slug($request->username)]);
        
        //validacion
        // required|min:5 o como arreglo ['required','min:5'] separado por | podemos poner varias condiciones (min:5 es minimo 5 caracteres)
        // unique.users sirve para verificar que en la tabla users que yala crea laravel el username sea unico 
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => "required|unique:users|min:3|max:20",
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);
        
        //equivale aun insert into insertar un registro en bd 
       User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
       ]);

    //    Hash para hashear claveas es como encriptar
    // str::lower volver todo a miniscula
    // str::slug lo va a convertir en una url: sustituye los espcios por - y quita los acentos 


    //    autenticar usuario
    //    auth()->attempt([
    //     'email'=> $request->email,
    //     'password'=> Hash::make($request->password)
    //    ]);

    // otra forma de autenticar
    auth()->attempt($request->only('email', 'password'));


    // redirecciona es un helper 
    return redirect()->route('posts.index', auth()->user()->username);
    }
}
