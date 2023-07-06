<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    private $services = ['news', 'games', 'breaking-news', 'sports', 'politics', 'weather'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->services as $item) {
            DB::table('services')->insert(['name' => $item]);
        }
    }
}
