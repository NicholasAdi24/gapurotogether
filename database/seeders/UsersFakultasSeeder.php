<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersFakultasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users_fakultas')->insert([
            // Dekan Fakultas dan Sekolah
            ['users_id' => 150, 'fakultas_id' => 1],
            ['users_id' => 151, 'fakultas_id' => 2],
            ['users_id' => 152, 'fakultas_id' => 3],
            ['users_id' => 153, 'fakultas_id' => 4],
            ['users_id' => 154, 'fakultas_id' => 5],
            ['users_id' => 155, 'fakultas_id' => 6],
            ['users_id' => 156, 'fakultas_id' => 7],
            ['users_id' => 157, 'fakultas_id' => 8],
            ['users_id' => 158, 'fakultas_id' => 9],
            ['users_id' => 159, 'fakultas_id' => 10],
            ['users_id' => 160, 'fakultas_id' => 11],
            ['users_id' => 161, 'fakultas_id' => 12],
            ['users_id' => 162, 'fakultas_id' => 13],
            // End Dekan Fakultas dan Sekolah

            // Start Wakil Dekan 1 Fakultas dan Sekolah
            ['users_id' => 163, 'fakultas_id' => 1],
            ['users_id' => 164, 'fakultas_id' => 2],
            ['users_id' => 165, 'fakultas_id' => 3],
            ['users_id' => 166, 'fakultas_id' => 4],
            ['users_id' => 167, 'fakultas_id' => 5],
            ['users_id' => 168, 'fakultas_id' => 6],
            ['users_id' => 169, 'fakultas_id' => 7],
            ['users_id' => 170, 'fakultas_id' => 8],
            ['users_id' => 171, 'fakultas_id' => 9],
            ['users_id' => 172, 'fakultas_id' => 10],
            ['users_id' => 173, 'fakultas_id' => 11],
            ['users_id' => 174, 'fakultas_id' => 12],
            ['users_id' => 175, 'fakultas_id' => 13],
            // End Wakil Dekan 1 Fakultas dan Sekolah

            // Start TPMF Fakultas dan Sekolah
            ['users_id' => 8, 'fakultas_id' => 1],
            ['users_id' => 181, 'fakultas_id' => 2],
            ['users_id' => 182, 'fakultas_id' => 3],
            ['users_id' => 183, 'fakultas_id' => 4],
            ['users_id' => 184, 'fakultas_id' => 5],
            ['users_id' => 185, 'fakultas_id' => 6],
            ['users_id' => 186, 'fakultas_id' => 7],
            ['users_id' => 187, 'fakultas_id' => 8],
            ['users_id' => 188, 'fakultas_id' => 9],
            ['users_id' => 189, 'fakultas_id' => 10],
            ['users_id' => 190, 'fakultas_id' => 11],
            ['users_id' => 191, 'fakultas_id' => 12],
            ['users_id' => 192, 'fakultas_id' => 13],
            // End TPMF Fakultas dan Sekolah

        ]);
    }
}
