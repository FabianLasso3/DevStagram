@extends('layouts.app')

@section('titulo')
    Iniciar sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-7/12 p-4">
            <img src="{{ asset('img/login.jpg') }}" alt="login usuario">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            {{-- novalidate sirve para quitar la validacion de html5 para que ejecute la validacioon de laravel --}}
            <form method="POST" action="{{ route('login') }}" novalidate>
                {{-- ayuda evitar un tipo de ataques sirve para la seguridad --}}
                @csrf 
               
                @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>
                @endif

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

                <div class="mb-5">
                    <input type="checkbox" name="remember" <label class="text-gray-500 text-sm"> Mantener sesión abierta<label> 
                </div>

                {{-- _confirmation laravel se encarga de escanear ese input y verifica si son iguales usando el sonfirmation --}}
               
                <input type="submit" value="Iniciar sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>
            </form>
        </div>
    </div>
@endsection