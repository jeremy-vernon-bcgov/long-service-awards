<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AwardOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //WATCHES
        DB::table('award_options')->insert(['id' => 1, 'award_id'=> 9, 'name' => 'Watch Size', 'short_name' => 'Size', 'type' => 'select', 'select_options' => '"38 mm watch face, 20 mm strap width", "29mm face with 14mm strap"']);
        DB::table('award_options')->insert(['id' => 2, 'award_id'=> 9, 'name' => 'Watch Colour', 'short_name' => 'Colour' , 'type' => 'select', 'select_options' => '"Gold", "Silver", "Two-Toned (Gold and Silver)']);
        DB::table('award_options')->insert(['id' => 3, 'award_id'=> 9, 'name' => 'Strap Colour' , 'short_name' => 'Strap' , 'type' => 'select' , 'select_options' => '"Plated","Black", "Brown"']);
        DB::table('award_options')->insert(['id' => 4, 'award_id'=> 9, 'name' => 'Engraving on Reverse', 'short_name' => 'Engraving', 'type' => 'text']);



        //PECSF Certificates
        DB::table('award_options')->insert(['id' => 5, 'award_id'=> 49, 'name' => 'Name on Certificate', 'short_name' => 'Cert Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 6, 'award_id'=> 50, 'name' => 'Name on Certificate', 'short_name' => 'Cert Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 7, 'award_id'=> 51, 'name' => 'Name on Certificate', 'short_name' => 'Cert Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 8, 'award_id'=> 52, 'name' => 'Name on Certificate', 'short_name' => 'Cert Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 9, 'award_id'=> 53, 'name' => 'Name on Certificate', 'short_name' => 'Cert Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 10, 'award_id'=> 54, 'name' => 'Name on Certificate', 'short_name' => 'Cert Name' , 'type' => 'text']);

        //Bracelets
        DB::table('award_options')->insert(['id' => 11, 'award_id'=> 12, 'name' => 'Bracelet Size', 'short_name' => 'Size', 'type' => 'select', 'select_options' => '"Fits 6 ½″ - 7 ½″ circumference wrists", "Fits 7 ½″ - 8 ½″ circumference wrists"']);
        DB::table('award_options')->insert(['id' => 12, 'award_id'=> 29, 'name' => 'Bracelet Size', 'short_name' => 'Size', 'type' => 'select', 'select_options' => '"Fits 6 ½″ - 7 ½″ circumference wrists", "Fits 7 ½″ - 8 ½″ circumference wrists"']);
        DB::table('award_options')->insert(['id' => 13, 'award_id'=> 48, 'name' => 'Bracelet Size', 'short_name' => 'Size', 'type' => 'select', 'select_options' => '"Fits 6 ½″ - 7 ½″ circumference wrists", "Fits 7 ½″ - 8 ½″ circumference wrists"']);






    }
}
