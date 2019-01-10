<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = 3;
        for($i=0; $i < $records; $i++){
            DB::table('users')->insert([
                'name' => 'test'.$i,
                'email' => 'test'.$i.'@test.com',
                'password' => app('hash')->make('pass'),
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
