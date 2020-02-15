<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //->get return a collection if there is 10 user with same email then it will get them all
        $user =User::where('email','elyesboudhina@gmail.com')->first();
        if (!$user)
        {
             User::create([
                'name' => 'Elyes Boudhina',
                'email' => 'elyesboudhina@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('admin')
            ]);
        }
    }
}
