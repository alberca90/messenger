<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::truncate();
        DB::table('Users')->insert([
            'name' => 'UNAWEB',
            'email' => 'soporte@unaweb.es',
            'password' => bcrypt('PromoS2018'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
    }
}
