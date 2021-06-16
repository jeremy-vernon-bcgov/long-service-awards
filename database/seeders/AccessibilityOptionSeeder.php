<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AccessibilityOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accessibility_options')->insert(['id' => '1','description' => 'Consideration for my mobility (e.g. cane, walker, or wheelchair)' , 'short_name' => 'Mobility', 'sort_order' => 6]);
        DB::table('accessibility_options')->insert(['id' => '2','description' => 'Accessible Parking' , 'short_name' => 'Parking', 'sort_order' => 2]);
        DB::table('accessibility_options')->insert(['id' => '3','description' => 'Reserved Seating' , 'short_name' => 'Seating', 'sort_order' => 1]);
        DB::table('accessibility_options')->insert(['id' => '4','description' => 'Assistance at the Buffet' , 'short_name' => 'Buffet', 'sort_order' => 5]);
        DB::table('accessibility_options')->insert(['id' => '5','description' => 'Communication Access Realtime Translation (CART) services' , 'short_name' => 'CART', 'sort_order' => 9]);
        DB::table('accessibility_options')->insert(['id' => '6','description' => 'American Sign Language interpreter services' , 'short_name' => 'ASL', 'sort_order' => 3]);
        DB::table('accessibility_options')->insert(['id' => '7','description' => 'Large-print Commemorative Program' , 'short_name' => 'Large-Print', 'sort_order' => 4]);
        DB::table('accessibility_options')->insert(['id' => '8','description' => 'My guide/service dog to attend with me' , 'short_name' => 'Dog', 'sort_order' => 7]);
        DB::table('accessibility_options')->insert(['id' => '9','description' => 'My personal assistant to attend with me' , 'short_name' => 'Assistant', 'sort_order' => 8]);
        DB::table('accessibility_options')->insert(['id' =>'10', 'description' => 'Other', 'short_name' => 'Other', 'sort_order'=> 10]);
    }
}
