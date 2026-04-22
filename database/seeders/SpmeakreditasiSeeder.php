<?php

namespace Database\Seeders;

use App\Models\Spmeakreditasi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SpmeakreditasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'programstudis_id' => 49,
                'no_sk' => '000165.A',
                'tahun' => 2024,
                'masa_mulai' => '2024-04-01',
                'masa_akhir' => '2029-03-31',
                'akreditasi' => 'Internasional',
                'skor' => 2024,
                'type' => 2,
                'berkas' => '02-04-24-10-00-36-17.pdf',
                'lembaga' => 'IABEE',
                'keterangan' => '',
                'updateby' => 'superadmin',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'programstudis_id' => 49,
                'no_sk' => '0132/SK/LAM Teknik/Smtr/V/2024',
                'tahun' => 2024,
                'masa_mulai' => '2024-05-13',
                'masa_akhir' => '2024-08-20',
                'akreditasi' => 'UNGGUL',
                'skor' => 2024,
                'type' => 1,
                'berkas' => '16-05-24-13-45-52-17.pdf',
                'lembaga' => 'LAM Program Studi Keteknikan',
                'keterangan' => '',
                'updateby' => 'superadmin',
                'status' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'programstudis_id' => 49,
                'no_sk' => '0240/SK/LAM Teknik/Smtr/VIII/2024',
                'tahun' => 2024,
                'masa_mulai' => '2024-08-07',
                'masa_akhir' => '2024-12-20',
                'akreditasi' => 'UNGGUL',
                'skor' => 2024,
                'type' => 1,
                'berkas' => '06-08-24-10-31-09-17.pdf',
                'lembaga' => 'LAM Program Studi Keteknikan',
                'keterangan' => '',
                'updateby' => 'superadmin',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];


        Spmeakreditasi::insert($data);
    }
}
