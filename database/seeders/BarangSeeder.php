<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1, 
                'barang_kode' => 'IC', 
                'barang_nama' => 'Instant Coffe',
                'harga_beli' => 30000,
                'harga_jual' => 35000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1, 
                'barang_kode' => 'GT', 
                'barang_nama' => 'Green Tea',
                'harga_beli' => 25000,
                'harga_jual' => 32000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1, 
                'barang_kode' => 'GB', 
                'barang_nama' => 'Granola Bars',
                'harga_beli' => 15000,
                'harga_jual' => 25000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2, 
                'barang_kode' => 'DT', 
                'barang_nama' => 'Detergent',
                'harga_beli' => 15000,
                'harga_jual' => 25000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 2, 
                'barang_kode' => 'AF', 
                'barang_nama' => 'Air Freshener',
                'harga_beli' => 10000,
                'harga_jual' => 17000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3, 
                'barang_kode' => 'MG', 
                'barang_nama' => 'Moisturizing',
                'harga_beli' => 25000,
                'harga_jual' => 35000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 3, 
                'barang_kode' => 'AD', 
                'barang_nama' => 'Antipespirant Deodorant',
                'harga_beli' => 15000,
                'harga_jual' => 25000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4, 
                'barang_kode' => 'DP', 
                'barang_nama' => 'Diapers',
                'harga_beli' => 50000,
                'harga_jual' => 55000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5, 
                'barang_kode' => 'VC', 
                'barang_nama' => 'Vitamin C Serum',
                'harga_beli' => 35000,
                'harga_jual' => 45000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5, 
                'barang_kode' => 'SC', 
                'barang_nama' => 'Sunscreen',
                'harga_beli' => 40000,
                'harga_jual' => 45000,
            ],
        ];
        DB::table('m_barangs')->insert($data); 
    }
}
