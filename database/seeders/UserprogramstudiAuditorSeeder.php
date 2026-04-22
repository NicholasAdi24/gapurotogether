<?php

namespace Database\Seeders;

use App\Models\Userprogramstudi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserprogramstudiAuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 134, 'users_id' => 12, 'programstudis_id' => 51, 'status' => 1, 'tahun' => 2024, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')], // Auditor untuk Prodi S1 Teknik Komputer
        ];

        Userprogramstudi::insert($data);
    }
}
