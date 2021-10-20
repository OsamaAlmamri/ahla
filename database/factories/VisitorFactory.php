<?php

namespace Database\Factories;

use App\Models\Occasion;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ar_YE');
        $o=Occasion::get()->last();
        return [
            //
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone'=>$this->faker->phoneNumber(),
            'company'=>$this->faker->company(),
            "occasion_id"=>$o->id,
            'qr_code'=>strtoupper(uniqid()),
        ];
    }
}
