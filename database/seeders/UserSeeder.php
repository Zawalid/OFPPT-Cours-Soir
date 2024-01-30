<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run(): void
    {
       $user1= User::create([        
            'name'=>'hassan',
            'email'=>'hassan@ofppt.com',
            'email_verified_at'=>now(),
            'password'=>'hassan123',   
        ])->assignRole('super-admin');
        
       $user1= User::create([        
            'name'=>'walid',
            'email'=>'walid@ofppt.com',
            'email_verified_at'=>now(),
            'password'=>'walid123',   
        ])->assignRole('admin');

       $user1= User::create([        
            'name'=>'ziko',
            'email'=>'ziko@ofppt.com',
            'email_verified_at'=>now(),
            'password'=>'ziko1234',   
        ])->assignRole('gestionnaire');
    }
}
