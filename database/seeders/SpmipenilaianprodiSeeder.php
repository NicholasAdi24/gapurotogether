<?php

namespace Database\Seeders;

use App\Models\Spmipenilaianprodi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SpmipenilaianprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'lembagas_id' => 1,
                'programstudis_id' => 51,
                'spmi_periodes_id' => 1,
                'tahun' => 2024,
                'nilai_prodi_final' => 4,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 2,
                'lembagas_id' => 1,
                'programstudis_id' => 49,
                'spmi_periodes_id' => 1,
                'tahun' => 2024,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 3,
                'lembagas_id' => 1,
                'programstudis_id' => 54,
                'spmi_periodes_id' => 1,
                'tahun' => 2024,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 4,
                'lembagas_id' => 1,
                'programstudis_id' => 24,
                'spmi_periodes_id' => 1,
                'tahun' => 2024,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 5,
                'lembagas_id' => 7,
                'programstudis_id' => 51,
                'spmi_periodes_id' => 2,
                'tahun' => 2025,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 6,
                'lembagas_id' => 7,
                'programstudis_id' => 79,
                'spmi_periodes_id' => 2,
                'tahun' => 2025,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 7,
                'lembagas_id' => 7,
                'programstudis_id' => 125,
                'spmi_periodes_id' => 2,
                'tahun' => 2025,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 8,
                'lembagas_id' => 7,
                'programstudis_id' => 65,
                'spmi_periodes_id' => 2,
                'tahun' => 2025,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 9,
                'lembagas_id' => 10,
                'programstudis_id' => 51,
                'spmi_periodes_id' => 3,
                'tahun' => 2025,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 10,
                'lembagas_id' => 10,
                'programstudis_id' => 79,
                'spmi_periodes_id' => 3,
                'tahun' => 2025,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 11,
                'lembagas_id' => 10,
                'programstudis_id' => 125,
                'spmi_periodes_id' => 3,
                'tahun' => 2025,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
            [
                'id' => 12,
                'lembagas_id' => 10,
                'programstudis_id' => 65,
                'spmi_periodes_id' => 3,
                'tahun' => 2025,
                'nilai_prodi_final' => 0,
                'nilai_auditor_final' => 0,
                'skor_final' => 0,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'auditor_id' => NULL,
            ],
        ];

        Spmipenilaianprodi::insert($data);
    }
}