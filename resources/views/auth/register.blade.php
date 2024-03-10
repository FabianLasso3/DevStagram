@extends('layouts.app')

@section('titulo')
    Registrarte en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-7/12 p-4">
            <img src="{{ asset('img/registrar.jpg') }}" alt="registrar usuario">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            {{-- novalidate sirve para quitar la validacion de html5 para que ejecute la validacioon de laravel --}}
            {{-- helper route para obtener el name de la ruta --}}
            <form action="{{ route('register') }}" method="POST" novalidate>
                {{-- ayuda evitar un tipo de ataques cross site rquest sirve para la seguridad --}}
                @csrf 
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    {{-- old obtener el valor ingresado anteriormente --}}
                    <input id="name" name="name" type="text" placeholder="Ingresa tu nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name')}}"/>
                </div>
                {{-- {{$message}} utiliza mensajes de laravel para cada error --}}
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">username</label>
                    <input id="username" name="username" type="text" placeholder="Ingresa tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username')}}"/>
                </div>

                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input id="email" name="email" type="email" placeholder="Ingresa tu nombre tu email" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email')}}"/>
                </div>

                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input id="password" name="password" type="password" placeholder="Ingresa tu password" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"/>
                </div>

                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

                {{-- _confirmation laravel se encarga de escanear ese input y verifica si son iguales usando el sonfirmation --}}
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Ingresa tu password" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"/>
                </div>
                <input type="submit" value="Crear cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>
            </form>
        </div>
    </div>
@endsection