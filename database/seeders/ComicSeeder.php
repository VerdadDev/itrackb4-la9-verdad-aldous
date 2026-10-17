<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comic;

class ComicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comic::create([
            'title' => 'One Piece', 
            'author' => 'Eiichiro Oda', 
            'genre' => 'Adventure', 
            'rate' => 9, 
            'chapter' => 1050, 
            'is_completed' => false]);
    }
}
