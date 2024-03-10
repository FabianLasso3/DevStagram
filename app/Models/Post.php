<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        // fillable son los valores se van a incertar en la base de datos
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){
        //belongsto es una relacion inversa  
        //le pasamos el modelo con el que se va a relacionar 
        //una publicacion pertence aun usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
    } 

    public function comentarios(){
        //belongsto es una relacion inversa  
        //le pasamos el modelo con el que se va a relacionar 
        //una publicacion pertence aun usuario
        return $this->hasMany(Comentario::class);
    } 

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        //verificar si un usuario ya le dio like 135
        return $this->likes->contains('user_id', $user->id);
    }
}
