<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Crea un texto el numero es la cantidad de texto
            //Le pasamos los mismos atributos del modelo que vamos a probar
            //se lo prueba con php artisan tinker= cli para interactuar con la bd
            //App\Models\Post::factory() buscar el factori creo
            //Post::factory()->times(200) o > App\Models\Post::factory()->times(200)->create(); La cantidad de veces que se va a ejecutar
            //exit para salir
            //usar para pruebas de forma local
            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentence(20),
            'imagen' => $this->faker->uuid().'.jpg',
            'user_id' => $this->faker->randomElement([4, 5, 6]) 
        ];
    }
}
