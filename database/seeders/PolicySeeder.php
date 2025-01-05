<?php

namespace Database\Seeders;

use App\Models\Policy;
use App\Models\Terms;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Policy::create([
            'title' => 'Privacy Policy',
            'content' => 'Your privacy policy content here...',
        ]);
        Terms::create([
            'title' => 'term Policy',
            'content' => 'term...',
        ]);
    }
}
