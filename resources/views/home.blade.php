{{-- mostrar el contenido de otro archivo --}}
{{-- @extends es una directiva es para utilizar un layout principal --}}

@extends('layouts.app')

{{-- Apartir de este section este codigo se va a inyectar en el yield  lo que este dentro del section--}}
@section('titulo')
    principal
@endsection

@section('contenido')

    {{-- usar un componente  --}}
    {{-- asi mostramos lo que hay en el componente, si no se le va apasar informacion va asi <x-listar-post/>
        <x-listar-post>
        </x-listar-post>
        si se va a pasar se usan slots, si usa slots va asi, la ventaja de los slot es que son reutilizables
        se puede pasar multiples slot asi <x-slot:titulo>
        ejemplo
        <x-listar-post>
        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>

        <h1>Mostrando desde el slot</h1>
        </x-listar-post>

        para pasar variable a componente se usa : nombre=nombrevarablephp
        tiene que ir junto o genera un error :posts="$posts"
        --}}
    <x-listar-post :posts="$posts"/>

   
@endsection