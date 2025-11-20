<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = '
            <p>Designed by Sadhguru, Inner Engineering is a transformative program that includes simple Yoga practices, sessions and meditative processes guided by Sadhguru, and the transmission of Shambhavi Mahamudra Kriya, a powerful 21-minute Yogic process. This program helps you build a foundation of health, joy and exuberance, and establish a chemistry of blissfulness.</p>
            <p>Designed by Sadhguru, Inner Engineering is a transformative program that includes simple Yoga practices, sessions and meditative processes guided by Sadhguru, and the transmission of Shambhavi Mahamudra Kriya, a powerful 21-minute Yogic process. This program helps you build a foundation of health, joy and exuberance, and establish a chemistry of blissfulness.</p>
        ';

        $images = [
            'landing-page/images/source/image 41.png',
            'landing-page/images/source/image 41 (1).png',
            'landing-page/images/source/image 41 (2).png',
            'landing-page/images/source/image 41 (3).png',
            'landing-page/images/source/image 41 (4).png',
            'landing-page/images/source/image 41 (5).png',
            'landing-page/images/source/image 41 (6).png',
            'landing-page/images/source/image 41 (7).png'
        ];

        $ebooks = [];
        for($i=1;$i<=24;$i++){
            $no = rand(0,7);
            $ebooks[] = [
                'title' => 'Sadhguru - Karma - Inner Engineering',
                'slug' => 'ebooks-example-'.$i,
                'description' => $content,
                'user_id' => rand(1, 10),
                'file_url' => $images[$no],
                'cover_url' => $images[$no],
            ];
        }

        DB::table('ebooks')->insert($ebooks);
    }
}
