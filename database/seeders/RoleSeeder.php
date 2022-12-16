<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Roles;
use App\Models\Experts;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expert = Experts::create([
            'name' => 'superadmin', 
            'email' => 'kinshuk.mcs21@cs.du.ac.in',
            'phone_num' => '8945768945',
            'institution_name' => 'DUCS,University Of Delhi',
            'reg_num' => 'IND457896548975',
            'password' => bcrypt('superadmin')
        ]);
    
        $role = Role::create(['name' => Roles::SUPER_ADMIN]);
        Role::create(['name' => Roles::ADMIN]);
        Role::create(['name' => Roles::ANNOTATOR]);

        $expert->assignRole([$role->id]);
    }
}
