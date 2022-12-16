<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\Experts;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExpertSeeder extends Seeder
{
    public static function seedExperts(Array $emails,String $role){
        
        $users = Experts::factory(count($emails))->make();

        foreach ($users as $user) {
            Experts::create([
                'name' => $user->name,
                'email' => array_shift($emails),
                'phone_num' => $user->phone_num,
                'institution_name' => $user->institution_name,
                'reg_num' => $user->reg_num,
                'password' => $user->password // password
            ])->assignRole($role);
        }
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Experts::factory(5)->create()->each(function($expert) {
        //     $expert->assignRole(Roles::ANNOTATOR);
        // });
        
        $annotators = ["02octnikhil@gmail.com", "212175@lc2.du.ac.in",
        "adityasehrawat36@gmail.com", "aggarwalamisha31@gmail.com", "hashneet12kaur@gmail.com",
        "kanishcarav@gmail.com", "manvimudgal15@gmail.com", "nehaverma280398@gmail.com",
        "nikhilpal0301@gmail.com", "nikitapant99@gmail.com", "prarthnananda00@gmail.com",
        "prashant44082@gmail.com", "priyanshu1121997@gmail.com", "rupaligujral13@gmail.com",
        "shreemchoubey142@gmail.com", "uvaisqazi777@gmail.com"];

        ExpertSeeder::seedExperts($annotators,Roles::ANNOTATOR);

        $admins = ["asiwal@law.du.ac.in","parikshet.sirohi@gmail.com",
        "ssirpal@ducc.du.ac.in","vb.ducs@gmail.com","vikas007bca@gmail.com"];

        ExpertSeeder::seedExperts($admins,Roles::ADMIN);
    }
}
