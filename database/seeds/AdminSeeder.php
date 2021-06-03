<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'name'=>'Super Admin',
            'email'=>'super@admin.com',
            'contact'=>'9843180434',
            'status'=>1,
            'profile_picture'=>'nopp.jpg',
            'type'=>0,
            'gender'=>'male',
            'password'=>bcrypt('secret'),
            'created_at'=>\Carbon\Carbon::now()
        ]);
    }
}
