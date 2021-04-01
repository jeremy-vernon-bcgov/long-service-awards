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
        DB::table('award_options')->insert(['award_id'=>'9', 'name' => 'Watch Size', 'short_name' => 'Size', 'type' => 'select', 'select_options' => '"Large (38 mm) watch face, 25 mm strap width", " "']);
        DB::table('award_options')->insert(['award_id'=>'9', 'name' => 'Watch Colour', 'short_name' => 'Colour' , 'type' => 'select', 'select_options' => '"Gold", "Silver"']);
        DB::table('award_options')->insert(['award_id'=>'9', 'name' => 'Strap Colour' , 'short_name' => 'Strap' , 'type' => 'select' , 'select_options' => '"Black", "Brown"']);
        DB::table('award_options')->insert(['award_id'=>'9', 'name' => 'Engraving on Reverse', 'short_name' => 'Engraving', 'type' => 'text']);
    }
}
