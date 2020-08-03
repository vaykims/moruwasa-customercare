<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        factory(App\Complaint::class, 100)->create()->each(function($complaints){
            $complaints->save();
            });

        factory(App\Technician::class, 25)->create()->each(function($technicians){
            $technicians->save();
            });

    }
}
