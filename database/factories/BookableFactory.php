<?php

namespace Database\Factories;

use App\Models\Bookable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bookable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $suffix = [
            'Villa',
            'House',
            'Cottage',
            'Luxury Villa',
            'Cheap House',
            'Rooms',
            'Cheap Rooms',
            'Luxury Rooms',
            'Fancy Rooms'
        ];

        return [
            'title' => $this->faker->name . ' ' . Arr::random($suffix),
            'description' => Str::random(10),
        ];
    }
}
