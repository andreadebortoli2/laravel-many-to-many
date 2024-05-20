<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        for ($i = 0; $i < 20; $i++) {

            $project = new Project();
            $project->title = $faker->sentence();
            $project->slug = Str::of($project->title)->slug('-');
            $project->author = $faker->userName();
            $project->description = $faker->text();
            $project->image = $faker->imageUrl(700, 550, null, true, null, false, 'png');
            $project->save();
        }
    }
}
