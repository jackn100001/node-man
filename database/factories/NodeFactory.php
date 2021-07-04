<?php

namespace Database\Factories;

use App\Models\Node;
use Illuminate\Database\Eloquent\Factories\Factory;

class NodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Node::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'ip_address' => $this->faker->ipv4,
            'hostname' => $this->faker->domainName,
            'node_status_id' => $this->faker->numberBetween($min = 1, $max = 3) 
        ];
    }
}
