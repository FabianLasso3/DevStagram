@extends('layouts.app')

@section('titulo')
    Crear nueva publicacion
@endsection

{{-- para cargar el css en la driectiva de stack de app  --}}
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />    
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            {{-- Configuracion de dropzones para poder subir imagenes al servidor  --}}
            {{-- enctype="multipart/form-data" para subir imagenes--}}
            <form action="{{ route('imagenes.store') }}" method="post" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded 
            flex flex-col justify-center items-center">
            @csrf-
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                {{-- ayuda evitar un tipo de ataques cross site rquest sirve para la seguridad --}}
                @csrf 
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    {{-- old obtener el valor ingresado anteriormente --}}
                    <input id="titulo" name="titulo" type="text" placeholder="Titulo de la publicacion" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{ old('titulo')}}"/>
                </div>
                {{-- {{$message}} utiliza mensajes de laravel para cada error --}}
                @error('titulo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion</label>
                    {{-- old obtener el valor ingresado anteriormente --}}
                    <textarea id="descripcion" name="descripcion" placeholder="Descripcion de la publicacion" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">{{ old('descripcion')}}</textarea>
                </div>
                {{-- {{$message}} utiliza mensajes de laravel para cada error --}}
                @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

                <div class="mb-5">
                    {{-- Aqui recibo el valor del id enviado desde el app.js  --}}
                    <input name="imagen" type="hidden" value="{{ old('imagen') }}"/> 
                </div>
                @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

                <input type="submit" value="Publicar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>
            </form>
        </div>
    </div>
@endsection