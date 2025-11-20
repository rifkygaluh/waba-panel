<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = '<p>
                In an era where digital presence defines brand credibility, domain investing has evolved from a niche hobby into a strategic business. But as the industry grows, so do user expectations. Today’s domain platforms must go beyond basic buying and selling—they need to be smart, scalable, and secure.<br>
                So, what really sets a modern domain marketplace apart in 2025?
            </p>
            <p>WASHINGTON — Secretary of State Antony J. Blinken on Friday canceled a weekend trip to Beijing after a Chinese spy balloon was sighted above the Rocky Mountain state of Montana, igniting a frenzy of media coverage and political commentary over a machine that the Pentagon said posed no threat to the United States.</p>
            <p>Mr. Blinken called the Chinese surveillance an “irresponsible act” and a “clear violation of U.S. sovereignty and international law.”</p>
            <p>China’s “decision to take this action on the eve of my planned visit is detrimental to the substantive discussions that we were prepared to have,” he said at a news conference on Friday afternoon.</p>
            <p>
                Mr. Blinken canceled the trip after civilians in Montana this week began spotting the balloon, which the Pentagon said was an “intelligence-gathering” airship. Military officials had been monitoring the balloon for days, and Mr. Blinken and a deputy secretly confronted Chinese diplomats in Washington on Wednesday. But it became a diplomatic crisis only as media attention mounted on Thursday night and Republican politicians called for President Biden and Mr. Blinken to act.<br>
                The balloon’s presence and Mr. Blinken’s announcement added to the rising tensions between the two superpowers. The situation also underscored the sensitive politics in the United States as both Democratic and Republican leaders vie to be seen as sufficiently hawkish on China.
            </p>
            <p>Mr. Blinken had planned to leave Friday night for the trip, the first visit by a U.S. secretary of state to China since 2018. He had been expected to meet with President Xi Jinping and discuss a wide range of issues. But Mr. Blinken said he called Wang Yi, China’s top foreign policy official, on Friday and said he was postponing his trip because of the balloon.</p>';

        $data = [
            ['title' => 'Smart, Scalable, Secure: What Sets Modern Domain Platforms Apart in 2025', 'slug' => 'smart-scalable-secure', 'image_url' => 'landing-page/images/blog/Rectangle 60.png'],
            ['title' => 'Inside Market: Building Asia’s #1 Domain Marketplace for Investors', 'slug' => 'inside-market', 'image_url' => 'landing-page/images/blog/1753257222104.jpg'],
            ['title' => 'The Rise of Digital Real Estate: Why Domain Investing Is the New Gold', 'slug' => 'the-rise-of-digital', 'image_url' => 'landing-page/images/blog/image 42 (4).png'],
            ['title' => 'How to Turn Idle Domains into Steady Revenue Streams', 'slug' => 'how-to-turn-idle', 'image_url' => 'landing-page/images/blog/image 42.png']
        ];

        $blogs = [];
        for($i=1;$i<=24;$i++){
            $no = rand(0,3);
            $blogs[] = [
                'title' => $data[$no]['title'],
                'slug' => $data[$no]['slug'].'-'.$i,
                'content' => $content,
                'author_id' => rand(1, 10),
                'image_url' => $data[rand(0, 3)]['image_url'],
                'read_time' => rand(1, 5),
                'related_ids' => json_encode([1, 2, 3])
            ];
        }

        DB::table('blogs')->insert($blogs);
    }
}
