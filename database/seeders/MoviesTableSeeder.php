<?php

namespace Database\Seeders;
use App\Models\Movie; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert sample data
        Movie::create([
            'title' => 'Sample Movie 1',
            'description' => 'Description for Sample Movie 1.',
            'release_date' => '2022-01-01',
        ]);

        Movie::create([
            'title' => 'Sample Movie 2',
            'description' => 'Description for Sample Movie 2.',
            'release_date' => '2022-02-01',
        ]);

        // Add more data as needed
    }
}
