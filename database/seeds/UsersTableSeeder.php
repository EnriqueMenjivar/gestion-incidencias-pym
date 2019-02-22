<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /*

    //Other way
    public function run()
    {
    	//Admin
        DB::table('users')->insert([
        	'name' => 'Enrique',
        	'email' => 'oe.menjivart@gmail.com',
        	'password' => bcrypt('ues2019'),
        	'role' => 0,
        ]);

        //Support
        DB::table('users')->insert([
        	'name' => 'María',
        	'email' => 'support@gmail.com',
        	'password' => bcrypt('ues2019'),
        	'role' => 1,
        ]);

        //Client
        DB::table('users')->insert([
        	'name' => 'María',
        	'email' => 'client@gmail.com',
        	'password' => bcrypt('ues2019'),
        	'role' => 2,
        ]);
    }*/

    public function run(){

    	User::create([
    		'name' => 'Enrique',
    		'email' => 'enrique@gmail.com',
    		'password' => bcrypt('ues2019'),
    		'role' => 0
    	]);

    	User::create([
    		'name' => 'Magaly',
    		'email' => 'client@gmail.com',
    		'password' => bcrypt('ues2019'),
    		'role' => 2
    	]);
    }
    
}
