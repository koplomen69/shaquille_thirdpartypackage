<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        // Buat data dummy untuk Satuan
        DB::table('satuans')->insert([
        [
            'kode_satuan' => 'SAT001',
            'nama_satuan' => 'Pcs',
        ],

        [
            'kode_satuan' => 'SAT002',
            'nama_satuan' => 'unit',
        ]
    ]);

        // Tambahkan data dummy lainnya jika diperlukan
    }
}
