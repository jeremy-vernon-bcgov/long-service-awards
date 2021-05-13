<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {





        DB::table('organizations')->insert([
            ['id'   =>  1,
            'name' => 'Finance (Ministry of)',
            'short_name' => 'Finance']
        ]);
        DB::table('organizations')->insert([
        ['id'   =>  2,
            'name' => 'Transportation & Infrastructure (Ministry of)',
            'short_name' => 'Transportation & Infrastructure']
    ]);
        DB::table('organizations')->insert([
        ['id'   =>  3,
            'name' => 'Citizens Services (Ministry of)',
            'short_name' => 'Citizens Services']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  4,
            'name' => 'Agriculture, Food and Fisheries (Ministry of)',
            'short_name' => 'Agriculture']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  5,
            'name' => 'Attorney General (Ministry of the)',
            'short_name' => 'Attorney General']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  6,
            'name' => 'Advanced Education, Skills & Training (Ministry of)',
            'short_name' => 'Advanced Education, Skills & Training']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  7,
            'name' => 'Education (Ministry of)',
            'short_name' => 'Education']
    ]);
    DB::table('organizations')->insert([
        ['id'   => 8 ,
            'name' => 'Energy, Mines and Low Carbon Innovation (Ministry of)',
            'short_name' => 'Energy, Mines and Low Carbon Innovation']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  9,
            'name' => 'Environment & Climate Change Strategy (Ministry of)',
            'short_name' => 'Energy, Mines & Petroleum Resources']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  10,
            'name' => 'Forests, Lands, Natural Resource Operations & Rural Development (Ministry of)',
            'short_name' => 'Forests, Lands, Natural Resource Operations & Rural Development']
    ]);
    DB::table('organizations')->insert([
        ['id'   => 11 ,
            'name' => 'Health (Ministry of)',
            'short_name' => 'Health']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  12,
            'name' => 'Indigenous Relations & Reconciliation (Ministry of)',
            'short_name' => 'Indigenous Relations & Reconciliation']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  13,
            'name' => 'Jobs, Economic Recovery and Innovation (Ministry of)',
            'short_name' => 'Jobs, Economic Recovery and Innovation']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  14,
            'name' => 'Labour (Ministry of)',
            'short_name' => 'Labour']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  15,
            'name' => 'Mental Health & Addictions (Ministry of)',
            'short_name' => 'Mental Health & Addictions']
    ]);
    DB::table('organizations')->insert([
        ['id'   =>  16,
            'name' => 'Municipal Affairs (Ministry of)',
            'short_name' => 'Municipal Affairs']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  17,
            'name' => 'Public Safety & Solicitor General & Emergency B.C. (Ministry of)',
            'short_name' => 'Public Safety & Solicitor General & Emergency B.C.']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  18,
            'name' => 'Social Development & Poverty Reduction (Ministry of)',
            'short_name' => 'Social Development & Poverty Reduction']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  19,
            'name' => 'Tourism, Arts, Culture and Sport (Ministry of)',
            'short_name' => 'Tourism, Arts, Culture and Sport']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  20,
            'name' => 'Agricultural Land Commission',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 22 ,
            'name' => 'BC Arts Council,Arts Council',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 23 ,
            'name' => 'BC Farm Industry Review Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  24,
            'name' => 'BC Human Rights Tribunal',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  25,
            'name' => 'BC Pension Corporation',
            'short_name' => 'Pensions']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  26,
            'name' => 'Public Service Agency',
            'short_name' => 'PSA']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  27,
            'name' => 'BC Review Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 28 ,
            'name' => 'BC Transportation Financing Authority',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 29 ,
            'name' => 'Board Resourcing and Development Office',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 30 ,
            'name' => 'Building Code Appeal Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  31,
            'name' => 'Civil Resolution Tribunal',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 32 ,
            'name' => 'Community Care and Assisted Living Appeal Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  33,
            'name' => 'Community Living BC',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  34,
            'name' => 'Crown Agencies Resource Office',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 35 ,
            'name' => 'Destination BC',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  36,
            'name' => 'Elections BC',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 37 ,
            'name' => 'Employment and Assistance Appeal Tribunal',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  38,
            'name' => 'Employment Standards Tribunal',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  39,
            'name' => 'Environmental Appeal Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  40 ,
            'name' => 'Environmental Assessment Office',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  41,
            'name' => 'Financial Services Tribunal',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  42,
            'name' => 'Forest Appeals Commission',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 43 ,
            'name' => 'Forest Practices Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 44 ,
            'name' => 'Government Communications and Public Engagement',
            'short_name' => 'GCPE']
    ]);        DB::table('organizations')->insert([
        ['id'   => 45 ,
            'name' => 'Health Professions Review Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  46,
            'name' => 'Hospital Appeal Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  47 ,
            'name' => 'Independent Investigations Office',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 48 ,
            'name' => 'Industry Training Appeal Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  49 ,
            'name' => 'Intergovernmental Relations Secretariat',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 50 ,
            'name' => 'Islands Trust',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 51 ,
            'name' => 'Labour Relations Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  52,
            'name' => 'Legislative Assembly of British Columbia',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  53,
            'name' => 'Liquor Distribution Branch',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  54,
            'name' => 'Mental Health Review Board',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 55 ,
            'name' => 'Office of the Auditor General',
            'short_name' => 'Auditor General']
    ]);        DB::table('organizations')->insert([
        ['id'   => 56 ,
            'name' => 'Office of the Conflict of Interest Commissioner',
            'short_name' => 'Conflict of Interest']
    ]);        DB::table('organizations')->insert([
        ['id'   => 57 ,
            'name' => 'Office of the Fire Commissioner',
            'short_name' => 'Fire Commissioner']
    ]);        DB::table('organizations')->insert([
        ['id'   => 58 ,
            'name' => 'Office of the Information and Privacy Commissioner',
            'short_name' => 'Information & Privacy Commissioner']
    ]);        DB::table('organizations')->insert([
        ['id'   => 59 ,
            'name' => 'Office of the Merit Commissioner',
            'short_name' => 'Merit Commissioner']
    ]);        DB::table('organizations')->insert([
        ['id'   => 60 ,
            'name' => 'Office of the Ombudsperson',
            'short_name' => 'Ombudsperson']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  61 ,
            'name' => 'Office of the Police Complaint Commissioner',
            'short_name' => 'Police Complaints']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  62,
            'name' => 'Office of the Premier',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 63 ,
            'name' => 'Office of the Representative for Children and Youth',
            'short_name' => 'Representative for Children and Youth']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  64,
            'name' => 'Oil and Gas Appeal Tribunal',
            'short_name' => 'Oil and Gas Appeals']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  65,
            'name' => 'Passenger Transportation Board',
            'short_name' => 'Passenger Transportation']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  66,
            'name' => 'Property Assessment Appeal Board',
            'short_name' => 'Property Assessment Appeal']
    ]);        DB::table('organizations')->insert([
        ['id'   =>  67,
            'name' => 'Public Guardian and Trustee',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 68 ,
            'name' => 'Public Sector Employers’ Council Secretariat',
            'short_name' => '']
    ]);        DB::table('organizations')->insert([
        ['id'   => 69 ,
            'name' => 'Royal BC Museum',
            'short_name' => 'RBCM']
    ]);DB::table('organizations')->insert([
        ['id'   =>  70,
            'name' => 'Safety Standards Appeal Board',
            'short_name' => '']
    ]);DB::table('organizations')->insert([
        ['id'   =>  71 ,
            'name' => 'Surface Rights Board',
            'short_name' => '']
    ]);DB::table('organizations')->insert([
        ['id'   =>  72,
            'name' => 'BC Financial Services Authority',
            'short_name' => '']
    ]);DB::table('organizations')->insert([
        ['id'   => 73,
            'name' => 'Children and Family Development (Ministry of)',
            'short_name' => 'MCFD']
    ]);DB::table('organizations')->insert([
        ['id' => 74,
            'name' => 'Workers’ Compensation Appeal Tribunal',
            'short_name' => 'WCAT']
    ]);DB::table('organizations')->insert([
        ['id' => 75,
            'name' => 'Agritech Land Use Secretariat',
            'short_name' => 'ALUS']
    ]);DB::table('organizations')->insert([
        ['id' => 76,
            'name' => 'Office of the Human Rights Commissioner for BC',
            'short_name' => '']
    ]);
    }
}
