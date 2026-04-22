<?php

namespace Database\Seeders;

use App\Models\Spmiperiode;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SpmiperiodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'nama' => 'Review AMI 2024',
                'tanggal_mulai' => '2024-01-11',
                'tanggal_selesai' => '2024-12-11',
                'tahun' => 2024,
                'catatan' => 'Bisa',
                'keterangan' => 'Mohon patuhi sesuai aturan berikut yang berlaku',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'nama' => 'Lam Teknik v1',
                'tanggal_mulai' => '2025-01-11',
                'tanggal_selesai' => '2025-12-11',
                'tahun' => 2025,
                'catatan' => 'Bisa',
                'keterangan' => 'Mohon patuhi sesuai aturan berikut yang berlaku',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'nama' => 'Lam Teknik v2',
                'tanggal_mulai' => '2025-01-11',
                'tanggal_selesai' => '2025-12-11',
                'tahun' => 2025,
                'catatan' => 'Bisa',
                'keterangan' => 'Mohon patuhi sesuai aturan berikut yang berlaku',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Spmiperiode::insert($data);
    }
}
