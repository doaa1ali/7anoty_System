<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cemetery;

class CemeterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cemetery::factory(10)->create();
    }
}
