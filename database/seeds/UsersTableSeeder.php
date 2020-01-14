<?php

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
        $admin = [
            'name'=>'admin',
            'username'=>'admin',
            'phone'=>'01208971865',
            'email'=>'m.mohamed@cat.com.eg',
            'active'=>1,
            'type'=>1,
            'password'=>123456,
        ];
        \App\User::create($admin);
    }
}
