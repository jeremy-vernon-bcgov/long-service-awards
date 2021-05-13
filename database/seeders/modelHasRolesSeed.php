<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class modelHasRolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Super Users

        DB::table('model_has_roles')->insert(['role_id' => 4, 'model_type' => 'App\Models\User', 'model_id' => 1]);
        DB::table('model_has_roles')->insert(['role_id' => 4, 'model_type' => 'App\Models\User', 'model_id' => 2]);
        DB::table('model_has_roles')->insert(['role_id' => 4, 'model_type' => 'App\Models\User', 'model_id' => 3]);

        //Protocol

        DB::table('model_has_roles')->insert(['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 4]);
        DB::table('model_has_roles')->insert(['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 5]);
        DB::table('model_has_roles')->insert(['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 6]);

        //Admin

        DB::table('model_has_roles')->insert(['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => 7]);
        DB::table('model_has_roles')->insert(['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => 8]);
        DB::table('model_has_roles')->insert(['role_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => 9]);


        //Contacts
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 10]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 11]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 12]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 13]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 14]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 15]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 16]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 17]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 18]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 19]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 20]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 21]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 22]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 23]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 24]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 25]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 26]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 27]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 28]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 29]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 30]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 31]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 32]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 33]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 34]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 35]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 36]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 37]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 38]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 39]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 40]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 41]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 42]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 43]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 44]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 45]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 46]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 47]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 48]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 49]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 50]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 51]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 52]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 53]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 54]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 55]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 56]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 57]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 58]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 59]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 60]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 61]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 77]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 62]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 63]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 64]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 65]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 66]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 67]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 68]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 69]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 70]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 71]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 72]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 73]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 74]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 75]);
        DB::table('model_has_roles')->insert(['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 76]);

    }
}
