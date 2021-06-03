<?php

use Illuminate\Database\Seeder;
use App\Crudable;
class CrudableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'name'=>'company',
                'created_at'=>\Carbon\Carbon::now()
            ],
            [
                'name'=>'department',
                'created_at'=>\Carbon\Carbon::now()
            ],
            [
                'name'=>'section',
                'created_at'=>\Carbon\Carbon::now()
            ],
            [
                'name'=>'role',
                'created_at'=>\Carbon\Carbon::now()
            ],
            [
                'name'=>'admin',
                'created_at'=>\Carbon\Carbon::now()
            ],
            [
                'name'=>'employee',
                'created_at'=>\Carbon\Carbon::now()
            ],
            [
                'name'=>'employee_experience',
                'created_at'=>\Carbon\Carbon::now()
            ],
            [
                'name'=>'trash',
                'created_at'=>\Carbon\Carbon::now()
            ],
            [
                'name'=>'super_admin',
                'created_at'=>\Carbon\Carbon::now()
            ]
        ];
        Crudable::insert($data);
    }
}
