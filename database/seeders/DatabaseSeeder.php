<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Labels;
use Illuminate\Database\Seeder;
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
        \App\Models\Experts::factory(5)->create();

        for($i=1;$i<=10;$i++){
            Labels::updateOrCreate(
                ['label_num' => $i],
                [
                    'label_num' => $i,
                    'label_name' => 'Label '.$i,
                    'details' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt corporis, vel quod magni, odit, rem a quo minima quae numquam necessitatibus fuga soluta! Iure modi vitae facilis natus voluptates neque.'
                ]
            );
        }

        $this->call([
            ParagraphSeeder::class
        ]);
    }
}
