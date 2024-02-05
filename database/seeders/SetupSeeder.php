<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SetupSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
           
        DB::table('users')->insert([
            'name' => 'mamun mia',
            'phone' => '0144556324',
            'email' => 'mamunmia@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'mamunjhg',
            'role' => 1,
            'slug' => 'U'.uniqid(20),
            'created_at' =>Carbon::now()->toDateTimeString(),
        ]);
            //Basic data seed
        DB::table('basics')->insert([
            'basic_company' => 'Creative system by Mamun',
            'basic_title' => 'Software Company by mamun group of company',
            'basic_creator' => 1,
            'basic_slug' => 'B'.uniqid(20),
            'created_at' =>Carbon::now()->toDateTimeString(),
        ]);
            //Social Media data seed
        DB::table('social_media')->insert([
            'sm_facebook' => 'www.facebook.com',
            'sm_twitter' => '#',
            'sm_creator' => 1,
            'sm_slug' => 'SM'.uniqid(20),
            'created_at' =>Carbon::now()->toDateTimeString(),
        ]);

            //Contact Information data seed
        DB::table('contact_information')->insert([
            'ci_phone1' => '01996836200',
            'ci_email1' => 'mamun@gmail.com',
            'ci_address1' => 'Dhobaura,mymensingh',
            'ci_creator' => 1,
            'ci_slug' => 'CI'.uniqid(20),
            'created_at' =>Carbon::now()->toDateTimeString(),
        ]);

            //Roll data seed

            $rols=['Superadmin','Admin','Author','Editor','Subscriber'];
            foreach ($rols as $urole){
                DB::table('roles')->insert([
                    'role_name' => $urole,
                    'role_slug' => 'R'.uniqid(20),
                    'created_at' =>Carbon::now()->toDateTimeString(),
                ]);
            }
    }
}
