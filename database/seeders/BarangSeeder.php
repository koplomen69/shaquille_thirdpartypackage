<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barangs')->insert([
        [
            'kode_barang' => 'BRG001',
            'nama_barang' => 'Laptop',
            'harga_barang' => 10000000,
            'deskripsi_barang' => 'Laptop HP',
            'satuan_barang_id' => 1, // asumsi ID dari Satuan
        ],
        // Buat data dummy untuk Barang
        [
            'kode_barang' => 'BRG003',
            'nama_barang' => 'Pc',
            'harga_barang' => 13000000,
            'deskripsi_barang' => 'PC Gaming',
            'satuan_barang_id' => 2, // asumsi ID dari Satuan
        ],

        [
            'kode_barang' => 'BRG002',
            'nama_barang' => 'Printer',
            'harga_barang' => 5000000,
            'deskripsi_barang' => 'Printer merk Canon',

            'satuan_barang_id' => 2, // asumsi ID dari Satuan
        ]
        ]);


        // Tambahkan data dummy lainnya jika diperlukan
    }
}
