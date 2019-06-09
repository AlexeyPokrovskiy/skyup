<?php

use Illuminate\Database\Seeder;

use App\Apartment;

use Faker\Factory;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $faker = Factory::create();

       Apartment::truncate();

       for ($i=0;$i<100;$i++){
           Apartment::create([
               'name'      => $faker->company,
               'price'     => $faker->numberBetween(10,1000000),
               'bedrooms'  => $faker->numberBetween(1,10),
               'bathrooms' => $faker->numberBetween(1,10),
               'storeys'   => $faker->numberBetween(1,10),
               'garages'   => $faker->numberBetween(1,5),
           ]);
       }
    }
}
