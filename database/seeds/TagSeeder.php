<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['label'=>'Sport' , 'color'=>'Green'],
            ['label'=>'Cars' , 'color'=>'Black'],
            ['label'=>'Health' , 'color'=>'Blue'],
            ['label'=>'Technology' , 'color'=>'Red'],
            ['label'=>'News' , 'color'=>'Purple'],
            ['label'=>'Crypto' , 'color'=>'Brown'],
        ];

        foreach ($tags as $tag) {
            $new_tag = New Tag();
            $new_tag->label = $tag['label'];
            $new_tag->color = $tag['color'];
            $new_tag->save();
        };
    }
}
