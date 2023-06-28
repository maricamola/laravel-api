<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 100; $i++){

        $new_project =  New Project();
        $new_project->title = $faker->sentence();
        $new_project->slug = Project::generateSlug($new_project->title);
        // $new_project->type = $project['type'];
        $new_project->thumb = $faker->imageUrl($width = 640, $height = 480, $category = 'abstract', $randomize = true, $word = null);
        $new_project->date_creation = date('Y-m-d');
        $new_project->description = $faker->text(1000);
        $new_project->save();

        }
    }
}
