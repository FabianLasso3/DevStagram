{{-- para mostrar informacion  --}}
<div>
    @if($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        {{-- esta variable posts la obtenemos del controlador postcontroller --}}
        @foreach ($posts as $post)
            <div class="">
                {{-- al poner $post detecta el id de cada post --}}
                {{-- ['post' => $post, 'user' => $user] asi se le pasa multiples variables para personalizar la url --}}
                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                    <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                </a>
            </div>
        @endforeach
    </div>

    <div class="my-10">
        {{-- nos permite realizar la paginacion --}}
        {{ $posts->links() }}
    </div>
    @else
    <p class="text-center">No hay Publicaciones, sigue a alguien para poder mostrar sus publicaciones.</p>
    {{-- otra manera de hacerlo --}}
    {{-- forelse ($posts as $post)
        <h1> {{ $post->titulo }} </h1>
    empty
        <h1> No hay </h1>
    @endforelse --}}
    @endif
</div>