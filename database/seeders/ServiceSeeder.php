<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $percetakanId = DB::table('service_categories')->where('name', 'Percetakan')->first()->id;
        $fotokopiId = DB::table('service_categories')->where('name', 'Fotokopi')->first()->id;

        DB::table('services')->insert([
            ['service_category_id' => $percetakanId, 'name' => 'Print Hitam Putih'],
            ['service_category_id' => $percetakanId, 'name' => 'Print Warna'],
            ['service_category_id' => $percetakanId, 'name' => 'Laminating'],
            ['service_category_id' => $fotokopiId, 'name' => 'Scan Dokumen'],
            ['service_category_id' => $fotokopiId, 'name' => 'Jilid'],
            ['service_category_id' => $fotokopiId, 'name' => 'Fotokopi'],
        ]);
    }
}
