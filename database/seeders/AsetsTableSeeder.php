<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asets')->insert([
            [
                'id_barcode' => '902C01L150065',
                'nama_aset' => 'PERSONAL COMPUTER',
                'merk_aset' => 'LENOVO THINK CENTER',
                'tahun_beli' => '2015',
                'harga_beli' => 9700000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'R. SERVER',
                'keterangan' => '-',
                'created_at' => now()
            ],
            [
                'id_barcode' => '902C01G160003',
                'nama_aset' => 'PERSONAL COMPUTER',
                'merk_aset' => 'HP ALL IN ONE',
                'tahun_beli' => '2016',
                'harga_beli' => 10000000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'RUANG TAMU 1',
                'keterangan' => '-',
                'created_at' => now()
            ],
            [
                'id_barcode' => '902C02G160008',
                'nama_aset' => 'LAPTOP',
                'merk_aset' => 'APPLE',
                'tahun_beli' => '2016',
                'harga_beli' => 15000000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'R. STAFF LANTAI 4',
                'keterangan' => '-',
                'created_at' => now()
            ],
            [
                'id_barcode' => '902C01G170005',
                'nama_aset' => 'PERSONAL COMPUTER',
                'merk_aset' => 'DELL AIO INSPIRON 3068',
                'tahun_beli' => '2017',
                'harga_beli' => 9924000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'R. STAFF LANTAI 1',
                'keterangan' => '-',
                'created_at' => now()
            ],
            [
                'id_barcode' => '902C09G170007',
                'nama_aset' => 'TABLET',
                'merk_aset' => 'SAMSUNG GALAXY TAB S2 8 INCH',
                'tahun_beli' => '2017',
                'harga_beli' => 5800000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'R. WAKANWIL BIDANG KEUANGAN & MR',
                'keterangan' => '-',
                'created_at' => now()
            ],
            [
                'id_barcode' => '902C09G170009',
                'nama_aset' => 'TABLET',
                'merk_aset' => 'SAMSUNG GALAXY TAB S2 8 INCH',
                'tahun_beli' => '2017',
                'harga_beli' => 5800000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'R. TI LANTAI 4',
                'keterangan' => '-',
                'created_at' => now()
            ],
            [
                'id_barcode' => '902C09G170010',
                'nama_aset' => 'TABLET',
                'merk_aset' => 'SAMSUNG GALAXY TAB S2 8 INCH',
                'tahun_beli' => '2017',
                'harga_beli' => 5800000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'R. WAKANWIL BIDANG DHCA',
                'keterangan' => '-',
                'created_at' => now()
            ],
            [
                'id_barcode' => '902C01J180001',
                'nama_aset' => 'PERSONAL COMPUTER',
                'merk_aset' => 'LENOVO AIO520-22ICB',
                'tahun_beli' => '2018',
                'harga_beli' => 10950000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'R. STAFF LANTAI 1',
                'keterangan' => '-',
                'created_at' => now()
            ],
            [
                'id_barcode' => '902C01J180002',
                'nama_aset' => 'PERSONAL COMPUTER',
                'merk_aset' => 'LENOVO AIO520-22ICB',
                'tahun_beli' => '2018',
                'harga_beli' => 10950000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'R. STAFF LANTAI 2',
                'keterangan' => '-',
                'created_at' => now()
            ],
            [
                'id_barcode' => '902C01J180003',
                'nama_aset' => 'PERSONAL COMPUTER',
                'merk_aset' => 'LENOVO AIO520-22ICB',
                'tahun_beli' => '2018',
                'harga_beli' => 10950000,
                'kondisi_aset' => 1,
                'lokasi_aset' => 'R. STAFF LANTAI 2',
                'keterangan' => '-',
                'created_at' => now()
            ],
        ]);
    }
}
