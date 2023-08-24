<?php

namespace Database\Seeders;

use App\Models\Describe;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function formatSlug($name)
        {
            $slug = strtolower($name);
            $slug = str_replace(' ', '_', $slug);
            return $slug;
        }
        for ($i = 1; $i < 15; $i++) {
            // $project = Project::create(['name' => 'Project ' . $i, 'user_id' => 1, 'started_at' => '2023-08-22', 'slug' => formatSlug('Project ' . $i), 'visibility' => rand(0, 1) ? 'Public' : 'Private']);
            // $rand = rand(1, 20);
            // for ($j = 1; $j < $rand; $j++) {
            //     Describe::create(['title' => rand(0, 1) ? Str::random(10) : null, 'image' => rand(0, 1) ? 'images/logo.png' : null, 'content' => Str::random(255), 'project_id' => $project->id, 'order' => $j]);
            // }
        }
    }
}
