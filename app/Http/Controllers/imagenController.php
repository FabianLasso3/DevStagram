<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class imagenController extends Controller
{
    public function store(Request $request){
        // all() para ver todos los request
        //uuid para generar ids unicos para cada imagen

        $imagen = $request->file('file');
        $nombreImagen = Str::uuid(). "." . $imagen->extension();
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000); 
        $imagenPath = public_path('uploads'). "/" . $nombreImagen;
        $imagenServidor->save($imagenPath);
        return response()->json([ 'imagen' => $nombreImagen]);
    }
}
