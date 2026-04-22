<?php

namespace Database\Seeders;

use App\Models\Lembaga;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'nama' => 'BAN-PT',
                'kepanjangan' => 'Badan Akreditasi Nasional Perguruan Tinggi',
                'ruanglingkup' => 'Lembaga utama untuk akreditasi institusi perguruan tinggi dan program studi yang belum memiliki LAM.',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'nama' => 'LAM-PTKes',
                'kepanjangan' => 'Lembaga Akreditasi Mandiri Pendidikan Tinggi Kesehatan Indonesia',
                'ruanglingkup' => 'Prodi bidang kesehatan (kedokteran, keperawatan, farmasi, dsb)',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'nama' => 'LAMEMBA',
                'kepanjangan' => 'Lembaga Akreditasi Mandiri Ekonomi, Manajemen, Bisnis, dan Akuntansi',
                'ruanglingkup' => 'Prodi Ekonomi, Manajemen, Akuntansi',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'nama' => 'LAMINFOKOM',
                'kepanjangan' => 'Lembaga Akreditasi Mandiri Informatika dan Komputer',
                'ruanglingkup' => 'Prodi Informatika, Sistem Informasi, dll',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'nama' => 'LAMSAMA',
                'kepanjangan' => 'Lembaga Akreditasi Mandiri Sains Alam dan Ilmu Formal',
                'ruanglingkup' => 'Prodi MIPA seperti Matematika, Fisika, Biologi, Kimia',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'nama' => 'LAMDIK',
                'kepanjangan' => 'Lembaga Akreditasi Mandiri Kependidikan',
                'ruanglingkup' => 'Prodi Pendidikan dan Keguruan',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'nama' => 'LAM Teknik V1 2024',
                'kepanjangan' => 'Lembaga Akreditasi Mandiri Teknik',
                'ruanglingkup' => 'Prodi Teknik (Sipil, Elektro, Mesin, dsb)',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 8,
                'nama' => 'LAMPSI',
                'kepanjangan' => 'Lembaga Akreditasi Mandiri Psikologi Indonesia',
                'ruanglingkup' => 'Prodi Psikologi',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 9,
                'nama' => 'LAMBAGA',
                'kepanjangan' => 'Lembaga Akreditasi Mandiri Budaya, Agama, dan Humaniora',
                'ruanglingkup' => 'Prodi Filsafat, Agama, Humaniora',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'nama' => 'LAM Teknik V2 2025',
                'kepanjangan' => 'Lembaga Akreditasi Mandiri Teknik',
                'ruanglingkup' => 'Prodi Teknik (Sipil, Elektro, Mesin, dsb)',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],


        ];

        Lembaga::insert($data);
    }
}
