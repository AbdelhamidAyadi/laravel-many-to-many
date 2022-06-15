<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category'=>'Education' , 'color'=>'Green'],
            ['category'=>'Entertainment' , 'color'=>'Black'],
            ['category'=>'Inspirational' , 'color'=>'Blue'],
            ['category'=>'Promotional' , 'color'=>'Red'],
        ];

        foreach ($categories as $category) {
            $new_category = New Category();
            $new_category->name = $category['category'];
            $new_category->color = $category['color'];
            $new_category->save();
        };
    }
}
