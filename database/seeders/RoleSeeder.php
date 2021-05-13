<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Protocol',
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Contact',
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'Administration',
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'Superuser',
            'guard_name' => 'web'
        ]);
    }
}
