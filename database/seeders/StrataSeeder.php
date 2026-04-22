<?php

namespace Database\Seeders;

use App\Models\Strata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'nama_strata' => 'S1',
            ],
            [
                'id' => 2,
                'nama_strata' => 'D4',
            ],
            [
                'id' => 3,
                'nama_strata' => 'PROFESI',
            ],
            [
                'id' => 4,
                'nama_strata' => 'S2',
            ],
            [
                'id' => 5,
                'nama_strata' => 'S3',
            ],
            [
                'id' => 6,
                'nama_strata' => 'PPDS',
            ],
            [
                'id' => 7,
                'nama_strata' => 'PPDSS',
            ],
            [
                'id' => 8,
                'nama_strata' => 'IUP',
            ],
            [
                'id' => 9,
                'nama_strata' => 'TIDAK AKTIF',
            ],
        ];
        Strata::insert($data);

    }
}
