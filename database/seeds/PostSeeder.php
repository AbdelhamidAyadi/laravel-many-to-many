<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $category_id = Category::pluck('id')->toArray();
     
        for ($i=0; $i < 5 ; $i++) { 
            $new_post = New Post();
            $new_post->title = $faker->words(2, true);
            $new_post->category_id = Arr::random($category_id);
            $new_post->content = $faker->paragraph(5);
            $new_post->image = $faker->imageUrl(640, 480, 'animals', true ,'dogs');
            $new_post->slug = Str::of($new_post->title)->slug('-');
            $new_post->save();
        }
    }
    public function categories(){
        return $this->belongsTo('App/Models/Category');
    }
}
