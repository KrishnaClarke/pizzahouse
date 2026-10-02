<?php

namespace Database\Seeders;

use App\Models\Pizza;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Pizza::factory()->count(6)->create();
        Pizza::factory()->count(4)->completed()->create();
    }
}
