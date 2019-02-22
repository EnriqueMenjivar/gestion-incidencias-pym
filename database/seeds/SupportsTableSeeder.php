<?php

use Illuminate\Database\Seeder;
use App\User;

class SupportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	User::create([
    		'name' => 'Support S1',
    		'email' => 'support@gmail.com',
    		'password' => bcrypt('ues2019'),
    		'role' => 1
    	]);

    	User::create([
    		'name' => 'Support S2',
    		'email' => 'support2@gmail.com',
    		'password' => bcrypt('ues2019'),
    		'role' => 1
    	]);
    }
}
