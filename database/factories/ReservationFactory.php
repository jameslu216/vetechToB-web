<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Doctor;
use App\Models\Clinic;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;


class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(7),
            'customer_name' => $this->faker->name,
            'customer_id' => $this->faker->numberBetween(1, Customer::count()),
            'phone' => $this->faker->phoneNumber,
            'pet_name' => $this->faker->name,
            'pet_variety' => "doge",
            'pet_gender' => "male",
            'pet_age' => 2,
            'serve_type' => "surgery",
            'note' => "No note, no",
            'datetime' => $this->faker->dateTime(),
            // FIXME don't know whether this add foreign key method is valid
            'doctor_id' => $this->faker->numberBetween(1, Doctor::count()),
            'clinic_id' => $this->faker->numberBetween(1, Clinic::count())
        ];
    }
}