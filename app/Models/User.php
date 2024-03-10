<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // fillable son los valores se van a incertar en la base de datos
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //metodo
    public function posts(){
        //hasMany es la relacion de one to many 
        //le pasamos el modelo con el que se va a relacionar 
        //el usuario puede tener muchos posts
        return $this->hasMany(Post::class);
    } 

    public function likes(){
        //hasMany es la relacion de one to many 
        //le pasamos el modelo con el que se va a relacionar 
        //el usuario puede tener muchos posts
        return $this->hasMany(Like::class);
    }
    
    //almacena seguidores de un usuario 
    public function followers(){
        //asi toca cuando te sales de las convenciones de laravel
        // especificar lsa llaves foreanas 
        //va insertar el user_id y el follower_id
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

//comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user){
        //revisa la funcion followers revisa si ya esta siguiendo devuelve true o false
        //contains sirve para iterar 
        return $this->followers->contains( $user->id);
    }

    //almacena los que seguimos 
    public function followings(){
        //asi toca cuando te sales de las convenciones de laravel
        // especificar lsa llaves foreanas 
        //va insertar el user_id y el follower_id
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
}
