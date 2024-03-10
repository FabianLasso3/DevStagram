<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\imagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterController as ControllersRegisterController;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

//Editar perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

// el que muestra una vista debe tener de nombre index
//get es cuando visitas un sitio post cuando envias informacion a un servidor
// ->name('') darle un nombre a la ruta para que sea facil cambiarla
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class,'store'])->name('logout');

//si agragas {} dentro de la ruta se convierte en una variable en este caso va hacer que cada endponit se muestre con el username 
//lo que la convierte en una ruta dinamica en basa al ususario 
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//guardar comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('/imagenes', [imagenController::class, 'store'])->name('imagenes.store');

//Like en fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

//Siguiendo usuairos
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

//comando salva vidas php artisan route:clear por si no arranca la aplicacion o hay un error desconociodo 

//livewire framework fullstack para laravel: soluciona el problema de interaciones tipo que envias algo y se recarga la pagina  y realiza sitios dinamicos
//livewire mezclad de cliente y servidor utiliza templates de blade tambien realizaa peteciones ajax para actualizar y enviar informacion al servidor 
//el servidor obtiene los datos y realiza un re render del html se instala con composer require livewire/livewire
// php artisan make:livewire nombre-nombre crear componente de livewire, el - sirve para saber que la siguiente palabra va ir en mayusculas
// los componentes de livewire siempre deben retornar un div en el elemento padre


//utilizar php artisan view:clear para limpiar las vistas cuando se usa variables dianmicas limpia el cache

//crear componentes php artisan make:component nombre
// para usar un componente <x- nombre de la vista siempre que aparezca asi es un componente

//php artisan route:cache limpiar cache de las rutas por si los cambios no funcionan al momento 
//php artisan route:list nos dice las rutas de la aplicacion y donde hay variables es importante nos da informacion de como funciona el sistema


//Relaciones eloquent son metodos que existen en los modelos 
//un modelo tendra un metodo y un tipo de relacion, asi como el modelo con cual esta relacionado esto es una coleccion
// $user->post modelo usuario relacionado con post hay 6 tipos de rlaciones

//one to one: modelo asociado a otro modelo donde maximo puede tener un registro de ese modelo

//one to many: modelo puede tener muchos registros de otro modelo

//belongs to es una relacion inversa

//Has one of many: multiples modelos asociados, Has one Through: 1 a 1 pero añade otra relacion, Has many Through: relacionar datos por moelo intermedio



//php artisan make:model --migration --controller --factory Post crear controlador y modelo en una sola linea
//Dropzone para arrastrar imagenes y se suban al servidor
//Factory una forma de hacer testing a una bd, solo se usan en desarrollo

// get para recuperar datos
// post para enviar datos a servidor
// put para actualizar elemnto sino existe lo crea, reemplazo total de un Registro
// patch  usado para actualizar parcialmente
// delete eliminar un elemento

// convenciones controllesrs 
// get = index
// post = store
// delete = destroy  

// migraciones sistema de control de versiones para la bd
// algunos comandos 
// php artisan migrate ejecutar las migraciones 
// php artisan migrate:rollback volver a la ultima migracion 
// php artisan migrate:rollback --step=5 volver a la ultima migracion dando cantidad de cuantas migraciones deseo regresar 
// php artisan make:migration nombre crear migracion
// php artisan make:refresh elimina las migraciones



// laraverl incluye un ORM ( object relacionak mapper ) lo que hace sencillo interactura con la base de datos
// crear modelo php artisan make:model nombre 

//Crear Pollicy php artisan make:policy nombre --model-Post
//--model-post hace referencia al modelo al que lo quieres asociar

// Route::get('/nosotros', function(){
//     return view('nosotros');
// });

// Route::get('/tienda', function(){
//     return view('tienda');
// });

