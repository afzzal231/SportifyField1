<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SportSeeder extends Seeder
{
    public function run(): void
    {
        $sports = [
            ['name' => 'Tennis', 'image' => 'Tennis.jpeg'],
            ['name' => 'Padel', 'image' => 'Padel.jpeg'],
            ['name' => 'Tenis Meja', 'image' => 'Tennis Meja.jpeg'],
            ['name' => 'Badminton', 'image' => 'Badminton.jpeg'],
            ['name' => 'Futsal', 'image' => 'Futsal.jpeg'],
            ['name' => 'Volly', 'image' => 'Volly.jpeg'],
            ['name' => 'Renang', 'image' => 'Renang.jpeg'],
            ['name' => 'Basket', 'image' => 'Basket.jpeg'],
        ];

        foreach ($sports as $sport) {
            Sport::create([
                'name' => $sport['name'],
                'slug' => Str::slug($sport['name']),
                'image' => $sport['image'],
            ]);
        }
    }
}
