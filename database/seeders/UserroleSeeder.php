<?php

namespace Database\Seeders;

use App\Models\Userrole;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserroleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'users_id' => 1,
                'roles_id' => 1,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'users_id' => 2,
                'roles_id' => 2,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'users_id' => 3,
                'roles_id' => 3,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'users_id' => 4,
                'roles_id' => 4,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'users_id' => 5,
                'roles_id' => 5,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'users_id' => 6,
                'roles_id' => 6,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'users_id' => 7,
                'roles_id' => 7,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 8,
                'users_id' => 8,
                'roles_id' => 8,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'users_id' => 10,
                'roles_id' => 10,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 11,
                'users_id' => 11,
                'roles_id' => 11,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 12,
                'users_id' => 12,
                'roles_id' => 12,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 13,
                'users_id' => 1,
                'roles_id' => 9,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 15,
                'users_id' => 14,
                'roles_id' => 9,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            // Start Kaprodi Fakultas Teknik
            ['id' => 17, 'users_id' => 9, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 18, 'users_id' => 13, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 19, 'users_id' => 14, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 20, 'users_id' => 16, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 21, 'users_id' => 17, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 22, 'users_id' => 18, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 23, 'users_id' => 19, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 24, 'users_id' => 20, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 25, 'users_id' => 21, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 26, 'users_id' => 22, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 27, 'users_id' => 31, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 28, 'users_id' => 59, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 29, 'users_id' => 86, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 30, 'users_id' => 108, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 31, 'users_id' => 115, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 32, 'users_id' => 116, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 33, 'users_id' => 117, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 34, 'users_id' => 118, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 35, 'users_id' => 119, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 36, 'users_id' => 120, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 37, 'users_id' => 124, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 38, 'users_id' => 129, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 39, 'users_id' => 132, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 40, 'users_id' => 137, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 41, 'users_id' => 138, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi Fakultas Teknik

            // Start Kaprodi FISIP
            ['id' => 42, 'users_id' => 15, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 43, 'users_id' => 23, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 44, 'users_id' => 24, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 45, 'users_id' => 25, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 46, 'users_id' => 41, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 47, 'users_id' => 45, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 48, 'users_id' => 82, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 49, 'users_id' => 83, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 50, 'users_id' => 96, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 51, 'users_id' => 99, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 52, 'users_id' => 121, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 53, 'users_id' => 128, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi FISIP

            // Start Kaprodi FPP
            ['id' => 54, 'users_id' => 26, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 55, 'users_id' => 27, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 56, 'users_id' => 61, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 57, 'users_id' => 68, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 58, 'users_id' => 84, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 59, 'users_id' => 109, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 60, 'users_id' => 133, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi FPP

            // Start Kaprodi FPIK
            ['id' => 61, 'users_id' => 28, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 62, 'users_id' => 44, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 63, 'users_id' => 56, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 64, 'users_id' => 58, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 65, 'users_id' => 60, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 66, 'users_id' => 67, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 67, 'users_id' => 95, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 68, 'users_id' => 106, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 69, 'users_id' => 126, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 70, 'users_id' => 131, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi FPIK

            // Start Kaprodi FEB
            ['id' => 71, 'users_id' => 29,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 72, 'users_id' => 35,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 73, 'users_id' => 36,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 74, 'users_id' => 37,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 75, 'users_id' => 55,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 76, 'users_id' => 85,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 77, 'users_id' => 88,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 78, 'users_id' => 105, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 79, 'users_id' => 122, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi FEB

            // Start Kaprodi FIB
            ['id' => 80, 'users_id' => 30,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 81, 'users_id' => 32,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 82, 'users_id' => 46,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 83, 'users_id' => 63,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 84, 'users_id' => 64,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 85, 'users_id' => 65,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 86, 'users_id' => 98,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 87, 'users_id' => 112, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 88, 'users_id' => 114, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 89, 'users_id' => 135, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi FIB

            // Start Kaprodi FSM
            ['id' => 90, 'users_id' => 33, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 91, 'users_id' => 34, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 92, 'users_id' => 39, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 93, 'users_id' => 47, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 94, 'users_id' => 54, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 95, 'users_id' => 57, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 96, 'users_id' => 66, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 97, 'users_id' => 87, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 98, 'users_id' => 91, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 99, 'users_id' => 104, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 100, 'users_id' => 107, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 101, 'users_id' => 134, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi FSM

            // Start Kaprodi FK
            ['id' => 102, 'users_id' => 38, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 103, 'users_id' => 40, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 104, 'users_id' => 48, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 105, 'users_id' => 49, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 106, 'users_id' => 50, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 107, 'users_id' => 51, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 108, 'users_id' => 93, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 109, 'users_id' => 94, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 110, 'users_id' => 101, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 111, 'users_id' => 125, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi FK

            // Start Kaprodi FH
            ['id' => 112, 'users_id' => 42,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 113, 'users_id' => 43,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 114, 'users_id' => 92,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 115, 'users_id' => 100, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 116, 'users_id' => 123, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi FH

            // Start Kaprodi FKM
            ['id' => 117, 'users_id' => 52,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 118, 'users_id' => 53,  'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 119, 'users_id' => 102, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 120, 'users_id' => 103, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 121, 'users_id' => 110, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 122, 'users_id' => 130, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi FKM

            // Start Kaprodi Psikologi
            ['id' => 123, 'users_id' => 62, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 124, 'users_id' => 111, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi Psikologi

            // Start Kaprodi Sekolah Vokasi
            ['id' => 125, 'users_id' => 69, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 126, 'users_id' => 70, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 127, 'users_id' => 71, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 128, 'users_id' => 72, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 129, 'users_id' => 73, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 130, 'users_id' => 74, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 131, 'users_id' => 75, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 132, 'users_id' => 76, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 133, 'users_id' => 77, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 134, 'users_id' => 78, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 135, 'users_id' => 79, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 136, 'users_id' => 80, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 137, 'users_id' => 81, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi Sekolah Vokasi

            // Start Kaprodi Sekolah Pascasarjana
            ['id' => 138, 'users_id' => 89, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 139, 'users_id' => 90, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 140, 'users_id' => 97, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 141, 'users_id' => 113, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 142, 'users_id' => 127, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 143, 'users_id' => 136, 'roles_id' => 9, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Kaprodi Sekolah Pascasarjana

            // Start Dekan Fakultas dan Sekolah
            ['id' => 144, 'users_id' => 150, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 145, 'users_id' => 151, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 146, 'users_id' => 152, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 147, 'users_id' => 153, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 148, 'users_id' => 154, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 149, 'users_id' => 155, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 150, 'users_id' => 156, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 151, 'users_id' => 157, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 152, 'users_id' => 158, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 153, 'users_id' => 159, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 154, 'users_id' => 160, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 155, 'users_id' => 161, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 156, 'users_id' => 162, 'roles_id' => 7, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Dekan Fakultas dan Sekolah

            // Start Wakil Dekan Fakultas dan Sekolah
            ['id' => 157, 'users_id' => 163, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 158, 'users_id' => 164, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 159, 'users_id' => 165, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 160, 'users_id' => 166, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 161, 'users_id' => 167, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 162, 'users_id' => 168, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 163, 'users_id' => 169, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 164, 'users_id' => 170, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 165, 'users_id' => 171, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 166, 'users_id' => 172, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 167, 'users_id' => 173, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 168, 'users_id' => 174, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 169, 'users_id' => 175, 'roles_id' => 13, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Wakil Dekan Fakultas dan Sekolah

            // Start Wakil Rektor 1 Universitas Diponegoro
            ['id' => 170, 'users_id' => 180, 'roles_id' => 14, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End Wakil Rektor 1 Universitas Diponegoro

            // Start TPMF Fakultas dan Sekolah
            ['id' => 171, 'users_id' => 181, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 172, 'users_id' => 182, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 173, 'users_id' => 183, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 174, 'users_id' => 184, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 175, 'users_id' => 185, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 176, 'users_id' => 186, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 177, 'users_id' => 187, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 178, 'users_id' => 188, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 179, 'users_id' => 189, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 180, 'users_id' => 190, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 181, 'users_id' => 191, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 182, 'users_id' => 192, 'roles_id' => 8, 'status' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            // End TPMF Fakultas dan Sekolah

        ];


        Userrole::insert($data);
    }
}
