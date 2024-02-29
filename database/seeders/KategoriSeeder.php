<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Kategori_id'=> 1, 
                'Kategori_kode' => 'FOOD', 
                'Kategori_nama' => 'Food Beverage'
            ],
            [
                'Kategori_id'=> 2, 
                'Kategori_kode' => 'HOME', 
                'Kategori_nama' => 'Home Care'
            ],
            [
                'Kategori_id'=> 3, 
                'Kategori_kode' => 'BODY', 
                'Kategori_nama' => 'Body Care'
            ],
            [
                'Kategori_id'=> 4, 
                'Kategori_kode' => 'BABY', 
                'Kategori_nama' => 'Baby Care'
            ],
            [
                'Kategori_id'=> 5, 
                'Kategori_kode' => 'BEAUTY', 
                'Kategori_nama' => 'Beauty Health``'
            ],
        ];
        DB::table('m_kategoris')->insert($data); 
    }
}
