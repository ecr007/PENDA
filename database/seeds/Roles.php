<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Role;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$roles = [
    		'Administrator'
    	];

    	foreach ($roles as $key) {
    		$rol = new Role();
            $rol->name = $key;
            $rol->slug = Str::slug($key);
            $rol->save();
    	}
    }
}
