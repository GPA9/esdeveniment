<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Esdeveniment;
use App\Models\Categoria;

class EsdevenimentFactory extends Factory
{
    protected $model = Esdeveniment::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->sentence(3),
            'descripcio' => $this->faker->text(200),
            'data' => $this->faker->date(),
            'hora' => $this->faker->time(),
            'num_max_assistents' => $this->faker->numberBetween(10, 200),
            'edat_minima' => $this->faker->numberBetween(0, 18),
            'imatge' => $this->faker->imageUrl(),
            'categoria_id' => Categoria::inRandomOrder()->first()->id,
        ];
    }
}