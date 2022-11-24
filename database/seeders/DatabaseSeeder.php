<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Labels;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\LabelSeeder;
use Database\Seeders\ExpertSeeder;
use Database\Seeders\ParagraphSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            ExpertSeeder::class,
            LabelSeeder::class, 
            ParagraphSeeder::class
        ]);
    }
}
