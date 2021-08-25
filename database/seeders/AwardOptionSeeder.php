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


        //Bracelets
        DB::table('award_options')->insert(['id' => 11, 'award_id'=> 12, 'name' => 'Bracelet Size', 'short_name' => 'Size', 'type' => 'select', 'select_options' => '"Fits 6 ½″ - 7 ½″ circumference wrists", "Fits 7 ½″ - 8 ½″ circumference wrists"']);
        DB::table('award_options')->insert(['id' => 12, 'award_id'=> 29, 'name' => 'Bracelet Size', 'short_name' => 'Size', 'type' => 'select', 'select_options' => '"Fits 6 ½″ - 7 ½″ circumference wrists", "Fits 7 ½″ - 8 ½″ circumference wrists"']);
        DB::table('award_options')->insert(['id' => 13, 'award_id'=> 48, 'name' => 'Bracelet Size', 'short_name' => 'Size', 'type' => 'select', 'select_options' => '"Fits 6 ½″ - 7 ½″ circumference wrists", "Fits 7 ½″ - 8 ½″ circumference wrists"']);


        //PECSF Certificates
        DB::table('award_options')->insert(['id' => 5, 'award_id'=> 49, 'name' => 'Name on Certificate', 'short_name' => 'Cert-Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 15, 'award_id' => 49, 'name' => 'Donation Type', 'short_name' => 'Type', 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 16, 'award_id' => 49, 'name' => 'Donation Region', 'short_name' => 'Region', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 17, 'award_id' => 49, 'name' => 'Charity 1 ID', 'short_name' => 'Charity-1', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 18, 'award_id' => 49, 'name' => 'Charity 2 ID', 'short_name' => 'Charity-2', 'type' => 'integer']);

        DB::table('award_options')->insert(['id' => 6, 'award_id'=> 50, 'name' => 'Name on Certificate', 'short_name' => 'Cert-Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 19, 'award_id' => 50, 'name' => 'Donation Type', 'short_name' => 'Type', 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 20, 'award_id' => 50, 'name' => 'Donation Region', 'short_name' => 'Region', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 21, 'award_id' => 50, 'name' => 'Charity 1 ID', 'short_name' => 'Charity-1', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 22, 'award_id' => 50, 'name' => 'Charity 2 ID', 'short_name' => 'Charity-2', 'type' => 'integer']);

        DB::table('award_options')->insert(['id' => 7, 'award_id'=> 51, 'name' => 'Name on Certificate', 'short_name' => 'Cert-Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 23, 'award_id' => 51, 'name' => 'Donation Type', 'short_name' => 'Type', 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 24, 'award_id' => 51, 'name' => 'Donation Region', 'short_name' => 'Region', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 25, 'award_id' => 51, 'name' => 'Charity 1 ID', 'short_name' => 'Charity-1', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 26, 'award_id' => 51, 'name' => 'Charity 2 ID', 'short_name' => 'Charity-2', 'type' => 'integer']);

        DB::table('award_options')->insert(['id' => 8, 'award_id'=> 52, 'name' => 'Name on Certificate', 'short_name' => 'Cert-Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 27, 'award_id' => 52, 'name' => 'Donation Type', 'short_name' => 'Type', 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 28, 'award_id' => 52, 'name' => 'Donation Region', 'short_name' => 'Region', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 29, 'award_id' => 52, 'name' => 'Charity 1 ID', 'short_name' => 'Charity-1', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 30, 'award_id' => 52, 'name' => 'Charity 2 ID', 'short_name' => 'Charity-2', 'type' => 'integer']);

        DB::table('award_options')->insert(['id' => 9, 'award_id'=> 53, 'name' => 'Name on Certificate', 'short_name' => 'Cert-Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 31, 'award_id' => 53, 'name' => 'Donation Type', 'short_name' => 'Type', 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 32, 'award_id' => 53, 'name' => 'Donation Region', 'short_name' => 'Region', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 33, 'award_id' => 53, 'name' => 'Charity 1 ID', 'short_name' => 'Charity-1', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 34, 'award_id' => 53, 'name' => 'Charity 2 ID', 'short_name' => 'Charity-2', 'type' => 'integer']);

        DB::table('award_options')->insert(['id' => 10, 'award_id'=> 54, 'name' => 'Name on Certificate', 'short_name' => 'Cert-Name' , 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 35, 'award_id' => 54, 'name' => 'Donation Type', 'short_name' => 'Type', 'type' => 'text']);
        DB::table('award_options')->insert(['id' => 36, 'award_id' => 54, 'name' => 'Donation Region', 'short_name' => 'Region', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 37, 'award_id' => 54, 'name' => 'Charity 1 ID', 'short_name' => 'Charity-1', 'type' => 'integer']);
        DB::table('award_options')->insert(['id' => 38, 'award_id' => 54, 'name' => 'Charity 2 ID', 'short_name' => 'Charity-2', 'type' => 'integer']);








    }
}
