<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{   
    public function __construct(){
        //de esta manera va estar protegido pero va apermitir a usuario no autenticados ver publicaciones
        //except permite que podamos ver ciertos archivos sin autenticarnos
        $this->middleware("auth")->except(['show', 'index']);
        // $this->middleware("auth"); el midelware se va a ejecutar antes del index revisa que el usuario este autenticado
    }

    public function index(User $user){
        //Filtrar las publicaciones del usuriario
        //paginate() nos sirve para hacer paginacion en este caso 20 son las imagenes que se van a mostrar
        //simplePaginate() nos vamos a mostrar paginacion solo con los botones de siguiente y atras
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);        
        // dd($user);
        //auth para autenticar un usuario
        // dd(auth()->user());

        return view("layouts.dashboard", [
            // las variables que pongamos aqui adentro las podemos usar en la vista que retorna eje el foreach de dashboards 
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //nos permite retornar una vista en este caso el formulario para crear publicacion
    public function create(){
        return view('posts.create');
    }

    //almacena en la bd
    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id

        ]);

        //Otra forma de insertar
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();


        //Otra forma de registrar usuarios pero usando realciones posts haria referencia a la relacion creada en el modelo en User
        // $request->user()->posts->create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post){
        //authorize hace referencia al metodo policy que vamos a utlizar se pasa el nombre y el post 
        $this->authorize('delete', $post);
        $post->delete();

        //Eliminar imagen de uploads
        // public_path apunta directamente a una ruta 
        $imagen_path = public_path('uploads/' . $post->imagen );

        if(File::exists($imagen_path)){
            //eliminar la imagen
            Unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
