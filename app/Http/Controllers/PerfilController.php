<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('perfil.index');
    }

    //siempre se le pasa un Request al store 
    public function store(Request $request){
        $request->request->add(['username' => str::slug($request->username)]);

        $this->validate($request, [
            // si hay mas de 3 validaciones debe ir en un array asi 
            // not_in:twitter palabras que no pueden elegir 
            // unique:users,username,'.auth()->user()->id si el usuario lo guarda osea tu propio isiaro xD
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter, editar-perfil'],
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid(). "." . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000); 
            $imagenPath = public_path('perfiles'). "/" . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        //Guardar cambios
        //- ?? es o 
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
