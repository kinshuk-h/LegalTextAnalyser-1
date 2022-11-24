<?php

namespace Database\Seeders;

use App\Models\Labels;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
