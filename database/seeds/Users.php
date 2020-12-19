<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Admin
        $admin = Role::where('slug','administrator')->first();

        $user = new User();

        $user->status = 1;
        $user->firstname = 'Ever';
        $user->lastname = 'Cuevas';
        $user->slug = Str::slug($user->firstname.' '.$user->lastname);
        $user->nickname = 'ever';
        $user->email = 'evercuevas1000@gmail.com';
        $user->phone = 809;
        $user->country = 'DO';
        $user->password = Hash::make('admin');
        $user->email_verified_at = now();

        $user->save();

        $user->roles()->attach($admin);
    }
}
