<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'nama_fakultas' => 'FAKULTAS HUKUM',
            ],
            [
                'id' => 2,
                'nama_fakultas' => 'FAKULTAS EKONOMIKA DAN BISNIS',
            ],
            [
                'id' => 3,
                'nama_fakultas' => 'FAKULTAS TEKNIK',
            ],
            [
                'id' => 4,
                'nama_fakultas' => 'FAKULTAS KEDOKTERAN',
            ],
            [
                'id' => 5,
                'nama_fakultas' => 'FAKULTAS PETERNAKAN DAN PERTANIAN',
            ],
            [
                'id' => 6,
                'nama_fakultas' => 'FAKULTAS ILMU BUDAYA',
            ],
            [
                'id' => 7,
                'nama_fakultas' => 'FAKULTAS ILMU SOSIAL DAN ILMU POLITIK',
            ],
            [
                'id' => 8,
                'nama_fakultas' => 'FAKULTAS KESEHATAN MASYARAKAT',
            ],
            [
                'id' => 9,
                'nama_fakultas' => 'FAKULTAS SAINS DAN MATEMATIKA',
            ],
            [
                'id' => 10,
                'nama_fakultas' => 'FAKULTAS PERIKANAN DAN ILMU KELAUTAN',
            ],
            [
                'id' => 11,
                'nama_fakultas' => 'FAKULTAS PSIKOLOGI',
            ],
            [
                'id' => 12,
                'nama_fakultas' => 'SEKOLAH PASCASARJANA',
            ],
            [
                'id' => 13,
                'nama_fakultas' => 'SEKOLAH VOKASI',
            ],
        ];
        Fakultas::insert($data);
    }
}
