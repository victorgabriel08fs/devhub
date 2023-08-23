<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            Project::create(['name' => 'Project ' . $i, 'user_id' => 1, 'started_at' => '2023-08-22', 'slug' => formatSlug('Project ' . $i)]);
        }
    }
}
