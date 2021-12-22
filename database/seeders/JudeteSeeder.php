<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class JudeteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('judete_table')->insert([
            ['id' => 1, 'cod' => 'AB', 'denumire' => 'Alba', 'populatie' => 373710],
            ['id' => 2, 'cod' => 'AR', 'denumire' => 'Arad', 'populatie' => 470093],
            ['id' => 3, 'cod' => 'AG', 'denumire' => 'Argeș', 'populatie' => 632124],
            ['id' => 4, 'cod' => 'BC', 'denumire' => 'Bacău', 'populatie' => 737629],
            ['id' => 5, 'cod' => 'BH', 'denumire' => 'Bihor', 'populatie' => 616264],
            ['id' => 6, 'cod' => 'BN', 'denumire' => 'Bistrița-Năsăud', 'populatie' => 327886],
            ['id' => 7, 'cod' => 'BT', 'denumire' => 'Botoșani', 'populatie' => 456130],
            ['id' => 8, 'cod' => 'BV', 'denumire' => 'Brașov', 'populatie' => 638000],
            ['id' => 9, 'cod' => 'BR', 'denumire' => 'Brăila', 'populatie' => 340804],
            ['id' => 10, 'cod' => 'B', 'denumire' => 'București', 'populatie' => 2151665],
            ['id' => 11, 'cod' => 'BZ', 'denumire' => 'Buzău', 'populatie' => 461039],
            ['id' => 12, 'cod' => 'CS', 'denumire' => 'Caraș-Severin', 'populatie' => 315473],
            ['id' => 13, 'cod' => 'CL', 'denumire' => 'Călărași', 'populatie' => 306820],
            ['id' => 14, 'cod' => 'CJ', 'denumire' => 'Cluj', 'populatie' => 736945],
            ['id' => 15, 'cod' => 'CT', 'denumire' => 'Constanța', 'populatie' => 763549],
            ['id' => 16, 'cod' => 'CV', 'denumire' => 'Covasna', 'populatie' => 225743],
            ['id' => 17, 'cod' => 'DB', 'denumire' => 'Dâmbovița', 'populatie' => 518645],
            ['id' => 18, 'cod' => 'DJ', 'denumire' => 'Dolj', 'populatie' => 686350],
            ['id' => 19, 'cod' => 'GL', 'denumire' => 'Galați', 'populatie' => 628104],
            ['id' => 20, 'cod' => 'GR', 'denumire' => 'Giurgiu', 'populatie' => 26922],
            ['id' => 21, 'cod' => 'GJ', 'denumire' => 'Gorj', 'populatie' => 355358],
            ['id' => 22, 'cod' => 'HR', 'denumire' => 'Harghita', 'populatie' => 330473],
            ['id' => 23, 'cod' => 'HD', 'denumire' => 'Hunedoara', 'populatie' => 453431],
            ['id' => 24, 'cod' => 'IL', 'denumire' => 'Ialomița', 'populatie' => 285100],
            ['id' => 25, 'cod' => 'IS', 'denumire' => 'Iași', 'populatie' => 965634],
            ['id' => 26, 'cod' => 'IF', 'denumire' => 'Ilfov', 'populatie' => 451839],
            ['id' => 27, 'cod' => 'MM', 'denumire' => 'Maramureș', 'populatie' => 520551],
            ['id' => 28, 'cod' => 'MH', 'denumire' => 'Mehedinți', 'populatie' => 277017],
            ['id' => 29, 'cod' => 'MS', 'denumire' => 'Mureș', 'populatie' => 590305],
            ['id' => 30, 'cod' => 'NT', 'denumire' => 'Neamț', 'populatie' => 566080],
            ['id' => 31, 'cod' => 'OT', 'denumire' => 'Olt', 'populatie' => 431248],
            ['id' => 32, 'cod' => 'PH', 'denumire' => 'Prahova', 'populatie' => 787529],
            ['id' => 33, 'cod' => 'SM', 'denumire' => 'Satu Mare', 'populatie' =>386110],
            ['id' => 34, 'cod' => 'SJ', 'denumire' => 'Sălaj', 'populatie' => 243525],
            ['id' => 35, 'cod' => 'SB', 'denumire' => 'Sibiu', 'populatie' => 469285],
            ['id' => 36, 'cod' => 'SV', 'denumire' => 'Suceava', 'populatie' => 764123],
            ['id' => 37, 'cod' => 'TR', 'denumire' => 'Teleorman', 'populatie' => 365976],
            ['id' => 38, 'cod' => 'TM', 'denumire' => 'Timiș', 'populatie' => 758380],
            ['id' => 39, 'cod' => 'TL', 'denumire' => 'Tulcea', 'populatie' => 234243],
            ['id' => 40, 'cod' => 'VS', 'denumire' => 'Vaslui', 'populatie' => 504879],
            ['id' => 41, 'cod' => 'VL', 'denumire' => 'Vâlcea', 'populatie' => 394725],
            ['id' => 42, 'cod' => 'VN', 'denumire' => 'Vrancea', 'populatie' => 382688],
        ]);
    }
}