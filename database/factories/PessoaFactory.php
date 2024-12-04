<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoa>
 */
class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = $this->faker->unique()->firstName() . " " . $this->faker->unique()->lastName();
        $status = Status::create(['status' => 'ATIVO']);
        return [
            'status_id' => $status->id,
            'nome'  =>  $nome,
            'email' => tornarEmail(converteParaSlug($nome,'.'), $this->faker->domainName()),
        ];
    }
}
