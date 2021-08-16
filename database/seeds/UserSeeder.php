<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputan['name']='sandy';
        $inputan['email']='sandyccloud3@gmail.com';
        $inputan['password']=Hash::make('12378');
        $inputan['phone']='081226241558';
        $inputan['role']='admin';
        User::create($inputan);
        
        
        
    }
}
