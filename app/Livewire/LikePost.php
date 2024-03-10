<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
// en este archivo podemos hacer consultas a la bd o validaciones 
    //en esta archivo no estan disponibles los request

    // al crear un atributo aqui ya esta disponible en la vista 
    public $post;
    public $isLiked; 
    public $likes;

    public function mount($post)
    {
        // el mount es como un constructor en php 
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        //revisa si el usuario que visita la pagina ya le dio like
        if($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('post_id', auth()->user()->id )->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }
    public function render()
    {
        return view('livewire.like-post');
    }
}
