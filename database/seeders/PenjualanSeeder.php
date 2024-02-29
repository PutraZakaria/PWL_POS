<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'Customer 1',
                'penjualan_kode' => 'K001',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 2,
                'pembeli' => 'Customer 2',
                'penjualan_kode' => 'K002',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Customer 3',
                'penjualan_kode' => 'K003',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 1,
                'pembeli' => 'Customer 4',
                'penjualan_kode' => 'K004',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Customer 5',
                'penjualan_kode' => 'K005',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Customer 6',
                'penjualan_kode' => 'K006',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 1,
                'pembeli' => 'Customer 7',
                'penjualan_kode' => 'K007',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 2,
                'pembeli' => 'Customer 8',
                'penjualan_kode' => 'K008',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Customer 9',
                'penjualan_kode' => 'K009',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 1,
                'pembeli' => 'Customer 10',
                'penjualan_kode' => 'K010',
                'penjualan_tanggal' => now(),
            ],
        ];
        DB::table('m_penjualans')->insert($data);
    }
}
