<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    private $clients = ['John Doe', 'Albert', 'Test User', 'George', 'Matilde'];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->clients as $key => $item) {
            $number = $key + 1;
            DB::table('clients')->insert([
                'name' => $item, 
                'number' => str_pad($number, 5, 0, STR_PAD_LEFT),
            ]);
        }
    }
}
