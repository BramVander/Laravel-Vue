<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Bookable;
use App\Models\Booking;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookable::all()->each(function (Bookable $bookable)
        {
            $bookings = Booking::factory(random_int(1,10))->create();
            $bookable->bookings()->saveMany($bookings->all());
        });
    }
}
