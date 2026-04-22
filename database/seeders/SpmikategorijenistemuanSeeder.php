<?php

namespace Database\Seeders;

use App\Models\Spmikategorijenistemuan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpmikategorijenistemuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'id' => 1,
                'kategori' => 'Bukan Temuan',
                'kode' => 'BT',
                'keterangan' => 'Penilaian dan Kelengkapan Baik tanpa adanya temuan',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'kategori' => 'Observer',
                'kode' => 'OB',
                'keterangan' => ' temuan/finding yang menunjukkan ketidakcukupan/ ketidaksesuaian terhadap persyaratan sistem penjaminan mutu, dan memerlukan penyempurnaan.',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'kategori' => 'KTS Minor',
                'kode' => 'KTSMi',
                'keterangan' => ' Ketidaksesuaian yang memiliki dampak terbatas terhadap sistem penjaminan mutu mutu',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'kategori' => 'KTS Mayor',
                'kode' => 'KTSMa',
                'keterangan' => 'Ketidaksesuaian yang memiliki dampak luas terhadap sistem penjaminan mutu.',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'kategori' => 'Temuan Positif',
                'kode' => 'TP',
                'keterangan' => 'sebuah prestasi dan juga bisa sebagai kesesuaian terhadap persyaratan/ standar.',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

        ];
        Spmikategorijenistemuan::insert($data);
    }
}
