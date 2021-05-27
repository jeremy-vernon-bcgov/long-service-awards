<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DietaryRestrictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dietary_restrictions')->insert(['id' => '1','short_name' => 'Dairy free']);
        DB::table('dietary_restrictions')->insert(['id' => '2','short_name' => 'Gluten free']);
        DB::table('dietary_restrictions')->insert(['id' => '3','short_name' => 'Sugar free']);
        DB::table('dietary_restrictions')->insert(['id' => '4','short_name' => 'No Shellfish']);
        DB::table('dietary_restrictions')->insert(['id' => '5','short_name' => 'Vegetarian']);
        DB::table('dietary_restrictions')->insert(['id' => '6','short_name' => 'Vegan']);
        DB::table('dietary_restrictions')->insert(['id' => '7','short_name' => 'Other']);
    }
}
