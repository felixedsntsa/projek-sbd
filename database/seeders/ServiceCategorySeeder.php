<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_categories')->insert([
            [
                'name' => 'Percetakan',
                'icon' => 'percetakan_icon.png'
            ],
            [
                'name' => 'Fotokopi',
                'icon' => 'fotokopi_icon.png'
            ]
        ]);
    }
}
