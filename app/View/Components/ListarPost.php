<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
    public $posts;
    public function __construct($posts)
    {
        //Aqui va ir la informacion que le vamos a pasar a los componentes 
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
        
     */
    //Render funcion que muestra una vista
    public function render(): View|Closure|string
    {
        return view('components.listar-post');
    }
}
