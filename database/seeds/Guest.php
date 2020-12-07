<?php

use Illuminate\Database\Seeder;

class Guest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 50)->create();

        $guest = App\Role::where('name','guest')->first();

        $users->each(function(App\User $user) use ($guest) {
            $user->roles()->attach($guest);
        });
    }
}
