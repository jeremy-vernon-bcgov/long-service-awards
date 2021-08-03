<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('awards')->insert(['id'=> 1,'name' => 'Cross® Pen',
                                                'short_name' => '25-pen' ,
                                                'image_path' => '25/25-pen.png',
                                                'description' => '',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 2,'name' => 'Bugatti® Padfolio',
                                                'short_name' => '25-case' ,
                                                'image_path' => '25/25-bugatti-padfolio.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 3,'name' => 'Passport and luggage tag set',
                                                'short_name' => '25-tags' ,
                                                'image_path' => '25/25-passport-luggage.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 4,'name' => 'Pearl earrings',
                                                'short_name' => '25-pearl-earrings' ,
                                                'image_path' => '25/25-pearl-earrings.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 5,'name' => 'Appalachian Sherpa blanket',
                                                'short_name' => '30-blanket' ,
                                                'image_path' => '30/30-blanket.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 6,'name' => 'Howard Miller® Colonnade clock',
                                                'short_name' => '30-colonnade' ,
                                                'image_path' => '30/30-colonnade-clock.png',
                                                'sort_order' => '5',
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 8,'name' => 'Sterling silver earrings',
                                                'short_name' => '30-silver-earrings' ,
                                                'image_path' => '30/30-silver-earrings',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 9,'name' => 'Bulova® watch',
                                                'short_name' => '35-bulova' ,
                                                'image_path' => '35/35-watches.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 10,'name' => 'Bushnell® Prime binoculars',
                                                'short_name' => '35-binoculars' ,
                                                'image_path' => '35/35-binoculars.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 11,'name' => 'Blue Flower Bouquet glass vase',
                                                'short_name' => '35-vase' ,
                                                'image_path' => '35/35-vase.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 12,'name' => 'Sterling silver bracelet',
                                                'short_name' => '35-bracelet' ,
                                                'image_path' => '35/35-bracelet.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 13,'name' => 'Ergo® Napoleon Beauty mantle clock',
                                                'short_name' => '40-napoleon' ,
                                                'image_path' => '40/40-napoleon-clock.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 14,'name' => 'Genuine diamond pendant and chain',
                                                'short_name' => '40-diamond-necklace' ,
                                                'image_path' => '40/40-diamond-necklace.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 15,'name' => 'Genuine diamond stud earrings',
                                                'short_name' => '40-diamond-earrings' ,
                                                'image_path' => '40/40-diamond-earrings.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 16,'name' => 'Blue Flower Bouquet glass bowl',
                                                'short_name' => '40-bowl' ,
                                                'image_path' => '40/40-bowl.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 17,'name' => '“Distant Shores” art print',
                                                'short_name' => '40-distant-shores' ,
                                                'image_path' => '40/40-distant-shores-art.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 18,'name' => 'Ergo® “Park” Clock',
                                                'short_name' => '45-park' ,
                                                'image_path' => '45/45-park-clock.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 19,'name' => 'Thule® Subterra Luggage',
                                                'short_name' => '45-luggage' ,
                                                'image_path' => '45-thule-luggage.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 20,'name' => 'Carson® Telescope',
                                                'short_name' => '45-telescope' ,
                                                'image_path' => '45/45-telescope.png',
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 21,'name' => 'Genuine Diamond Stud Earrings',
                                                'short_name' => '45-diamond-earrings' ,
                                                'image_path' => '45/45-diamond-earrings',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 22,'name' => 'Sterling Silver Gemstone Set',
                                                'short_name' => '50-gemstone-set' ,
                                                'image_path' => '50/50-earrings-bracelet.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 23,'name' => 'Crystal Pitcher and Glass Set',
                                                'short_name' => '50-pitcher' ,
                                                'image_path' => '50/50-crystal-pitcher-glasses.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 24,'name' => 'Citizen® Axiom Eco-Drive Watch',
                                                'short_name' => '50-citizen-watch' ,
                                                'image_path' => '50/50-citizen-axiom-watch.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 25,'name' => 'Bulova® "Yarmouth" Clock',
                                                'short_name' => '50-bulova-clock' ,
                                                'image_path' => '50/50-bulova-clock.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 27,'name' => '“Mirror Lake” art print',
                                                'short_name' => '50-mirror-lake' ,
                                                'image_path' => '50/50-mirror-lake.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 28,'name' => '“Wasting Time” framed art print',
                                                'short_name' => '45-wasting-time' ,
                                                'image_path' => '45/45-art-print.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 29,'name' => 'Sterling Silver Bracelet and Earrings',
                                                'short_name' => '45-earrings-bracelet' ,
                                                'image_path' => '45/45-earrings-bracelet.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 30,'name' => '“Flower Bouquet” Art Glass Bowl',
                                                'short_name' => '45-flower-bowl' ,
                                                'image_path' => '45/45-flower-bouquet-bowl.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 31,'name' => 'Pandora® Sterling Silver Bracelet',
                                                'short_name' => '45-pandora' ,
                                                'image_path' => '45/45-pandora-bracelet.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 32,'name' => 'Freshwater Pearl Necklace',
                                                'short_name' => '45-pearl-necklace' ,
                                                'image_path' => '45/45-pearl-necklace.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 33,'name' => 'Infinity Diamond Bracelet',
                                                'short_name' => '45-infinity' ,
                                                'image_path' => '45/45-infinity-bracelet.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 34,'name' => 'Anne Klein Watch',
                                                'short_name' => '45-anne-klein' ,
                                                'image_path' => '45/45-anne-klein-watch.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 35,'name' => 'Citizen® Axiom Eco-Drive Watch ',
                                                'short_name' => '45-citizen-watch' ,
                                                'image_path' => '45/45-citizen-axiom-watch.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 36,'name' => 'Bushnell® NatureView Binoculars and High Sierra® LED Lantern',
                                                'short_name' => '45-binoculars-lantern' ,
                                                'image_path' => '45/45-binoculars-lantern.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 37,'name' => '“Flower Bouquet” Art Glass Bowl',
                                                'short_name' => '50-flower-bowl' ,
                                                'image_path' => '50/50-flower-bouquet-bowl.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 38,'name' => 'Thule® Subterra Luggage',
                                                'short_name' => '50-luggage' ,
                                                'image_path' => '50/50-thule-luggage.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 39,'name' => 'Leather Messenger Bag',
                                                'short_name' => '50-messenger-bag' ,
                                                'image_path' => '50/50-messenger-bag.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 40,'name' => 'Bushnell® Nature View Binoculars and High Sierra® LED Lantern',
                                                'short_name' => '50-binoculars-lantern' ,
                                                'image_path' => '50/50-binoculars-lantern.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 41,'name' => 'Carson® Telescope',
                                                'short_name' => '50-telescope' ,
                                                'image_path' => '50/50-telescope.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 42,'name' => 'Ergo® “Park” Clock',
                                                'short_name' => '50-park-clock' ,
                                                'image_path' => '50/50-park-clock.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 43,'name' => 'Anne Klein Watch',
                                                'short_name' => '50-anne-klein' ,
                                                'image_path' => '50/50-anne-klein-watch.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 44,'name' => 'Pandora® Sterling Silver Bracelet',
                                                'short_name' => '50-pandora' ,
                                                'image_path' => '50/50-pandora-bracelet.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 45,'name' => 'Freshwater Pearl Necklace',
                                                'short_name' => '50-pearl-necklace' ,
                                                'image_path' => '50/50-pearl-necklace.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 46,'name' => 'Infinity Diamond Bracelet',
                                                'short_name' => '50-infinity' ,
                                                'image_path' => '50/50-infinity-bracelet.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 47,'name' => 'Genuine Diamond Stud Earrings',
                                                'short_name' => '50-diamond-earrings' ,
                                                'image_path' => '50/50-diamond-earrings.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 48,'name' => 'Sterling Silver Bracelet and Earrings',
                                                'short_name' => '50-earrings-bracelet' ,
                                                'image_path' => '50/50-earrings-bracelet.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 49,'name' => 'PECSF Donation',
                                                'short_name' => '25-pecsf' ,
                                                'image_path' => '25/1-pecsf.png',
                                                'sort_order' => 1,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 50,'name' => 'PECSF Donation',
                                                'short_name' => '30-pecsf' ,
                                                'image_path' => '30/1-pecsf.png',
                                                'sort_order' => 1,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 51,'name' => 'PECSF Donation',
                                                'short_name' => '35-pecsf' ,
                                                'image_path' => '35/1-pecsf.png',
                                                'sort_order' => 1,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 52,'name' => 'PECSF Donation',
                                                'short_name' => '40-pecsf' ,
                                                'image_path' => '40/1-pecsf.png',
                                                'sort_order' => 1,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 53,'name' => 'PECSF Donation',
                                                 'short_name' => '45-pecsf' ,
                                                 'image_path' => '45/1-pecsf.png',
                                                 'sort_order' => 1,
                                                 'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 54,'name' => 'PECSF Donation',
                                                'short_name' => '50-pecsf' ,
                                                'image_path' => '50/1-pecsf.png',
                                                'sort_order' => 1,
                                                'quantity' => -1]);
        DB::table('awards')->insert(['id'=> 55,'name' => 'Rothsbury Table Clock',
                                                'short_name' => '30-rothsbury' ,
                                                'image_path' => '30/30-rothsbury-clock.png',
                                                'sort_order' => 5,
                                                'quantity' => -1]);

    }
}
