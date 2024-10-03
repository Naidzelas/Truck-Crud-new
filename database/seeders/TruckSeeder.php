<?php

namespace Database\Seeders;

use App\Models\Transports\Transport;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transport::factory()->count(10)->create();
    }
}
