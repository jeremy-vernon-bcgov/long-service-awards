<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CeremonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ceremonies')->insert(['scheduled_datetime' => '2021-10-25 19:00:00']);
        DB::table('ceremonies')->insert(['scheduled_datetime' => '2021-10-26 19:00:00']);
        DB::table('ceremonies')->insert(['scheduled_datetime' => '2021-10-27 19:00:00']);
        DB::table('ceremonies')->insert(['scheduled_datetime' => '2021-11-05 19:00:00']);
        DB::table('ceremonies')->insert(['scheduled_datetime' => '2021-10-06 19:00:00']);

    }
}
