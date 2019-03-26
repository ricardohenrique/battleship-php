<?php

use Illuminate\Database\Seeder;
use App\Models\Ship;

class ShipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ship::firstOrCreate(['name' => 'Carrier', 'initials' => 'CA','size_x' => 1, 'size_y' => 5]);
        Ship::firstOrCreate(['name' => 'Battleship', 'initials' => 'BA','size_x' => 1, 'size_y' => 4]);
        Ship::firstOrCreate(['name' => 'Submarine', 'initials' => 'SU','size_x' => 1, 'size_y' => 3]);
        Ship::firstOrCreate(['name' => 'Cruiser', 'initials' => 'CR','size_x' => 1, 'size_y' => 2]);
        Ship::firstOrCreate(['name' => 'Patrol', 'initials' => 'PA','size_x' => 1, 'size_y' => 1]);
    }
}
