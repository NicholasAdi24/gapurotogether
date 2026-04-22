<?php

namespace Database\Seeders;

use App\Models\Programstudi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramstudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 63211,
                "nama_prodi" => "S1-ADMINISTRASI BISNIS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 63201,
                "nama_prodi" => "S1-ADMINISTRASI PUBLIK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 63202,
                "nama_prodi" => "S1-ADMINISTRASI PUBLIK K. REMBANG",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 5,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 54201,
                "nama_prodi" => "S1-AGRIBISNIS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 5,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 54211,
                "nama_prodi" => "S1-AGROEKOTEKNOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 54243,
                "nama_prodi" => "S1-AKUAKULTUR",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 62201,
                "nama_prodi" => "S1-AKUNTANSI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 6,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 82201,
                "nama_prodi" => "S1-ANTROPOLOGI SOSIAL",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 23201,
                "nama_prodi" => "S1-ARSITEKTUR",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 6,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 79204,
                "nama_prodi" => "S1-BAHASA DAN KEBUDAYAAN JEPANG",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 46201,
                "nama_prodi" => "S1-BIOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 54207,
                "nama_prodi" => "S1-BIOTEKNOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 61209,
                "nama_prodi" => "S1-BISNIS DIGITAL",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 60201,
                "nama_prodi" => "S1-EKONOMI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 60202,
                "nama_prodi" => "S1-EKONOMI ISLAM",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 48201,
                "nama_prodi" => "S1-FARMASI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 45201,
                "nama_prodi" => "S1-FISIKA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 13211,
                "nama_prodi" => "S1-GIZI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 64201,
                "nama_prodi" => "S1-HUBUNGAN INTERNASIONAL",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 1,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 74201,
                "nama_prodi" => "S1-HUKUM",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 1,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 77777,
                "nama_prodi" => "S1-HUKUM KAMPUS JEPARA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 54241,
                "nama_prodi" => "S1-ILMU KELAUTAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 70201,
                "nama_prodi" => "S1-ILMU KOMUNIKASI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 65201,
                "nama_prodi" => "S1-ILMU PEMERINTAHAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 6,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 71201,
                "nama_prodi" => "S1-ILMU PERPUSTAKAAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 55201,
                "nama_prodi" => "S1-INFORMATIKA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 11201,
                "nama_prodi" => "S1-KEDOKTERAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 12201,
                "nama_prodi" => "S1-KEDOKTERAN GIGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 14201,
                "nama_prodi" => "S1-KEPERAWATAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 66666,
                "nama_prodi" => "S1-KEPERAWATAN KAMPUS JEPARA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 8,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 13201,
                "nama_prodi" => "S1-KESEHATAN MASYARAKAT",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 8,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 13242,
                "nama_prodi" => "S1-KESELAMATAN DAN KESEHATAN KERJA (K3)",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 47201,
                "nama_prodi" => "S1-KIMIA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 61201,
                "nama_prodi" => "S1-MANAJEMEN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 54242,
                "nama_prodi" => "S1-MANAJEMEN SUMBER DAYA PERAIRAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 44201,
                "nama_prodi" => "S1-MATEMATIKA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 38201,
                "nama_prodi" => "S1-OSEANOGRAFI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 35201,
                "nama_prodi" => "S1-PERENCANAAN WILAYAH DAN KOTA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 54246,
                "nama_prodi" => "S1-PERIKANAN TANGKAP",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 5,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 54231,
                "nama_prodi" => "S1-PETERNAKAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 11,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 73201,
                "nama_prodi" => "S1-PSIKOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 6,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 79201,
                "nama_prodi" => "S1-SASTRA INDONESIA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 6,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 79202,
                "nama_prodi" => "S1-SASTRA INGGRIS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 6,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 80201,
                "nama_prodi" => "S1-SEJARAH",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 49201,
                "nama_prodi" => "S1-STATISTIKA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 20201,
                "nama_prodi" => "S1-TEKNIK ELEKTRO",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 29201,
                "nama_prodi" => "S1-TEKNIK GEODESI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 34201,
                "nama_prodi" => "S1-TEKNIK GEOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 26201,
                "nama_prodi" => "S1-TEKNIK INDUSTRI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 24201,
                "nama_prodi" => "S1-TEKNIK KIMIA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 56201,
                "nama_prodi" => "S1-TEKNIK KOMPUTER",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 25201,
                "nama_prodi" => "S1-TEKNIK LINGKUNGAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 21201,
                "nama_prodi" => "S1-TEKNIK MESIN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 36201,
                "nama_prodi" => "S1-TEKNIK PERKAPALAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 22201,
                "nama_prodi" => "S1-TEKNIK SIPIL",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 54244,
                "nama_prodi" => "S1-TEKNOLOGI HASIL PERIKANAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 5,
                "departemens_id" => NULL,
                "stratas_id" => 1,
                "kode_prodi" => 41221,
                "nama_prodi" => "S1-TEKNOLOGI PANGAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 62301,
                "nama_prodi" => "D4-AKUNTANSI PERPAJAKAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 44444,
                "nama_prodi" => "D4-AKUNTANSI PERPAJAKAN K. DEMAK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 99999,
                "nama_prodi" => "D4-AKUNTANSI PERPAJAKAN K. DEMAK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 79302,
                "nama_prodi" => "D4-BAHASA ASING TERAPAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 57302,
                "nama_prodi" => "D4-INFORMASI DAN HUBUNGAN MASYARAKAT",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 63314,
                "nama_prodi" => "D4-MANAJEMEN DAN ADMINISTRASI LOGISTIK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 35302,
                "nama_prodi" => "D4-PERENCANAAN TATA RUANG DAN PERTANAHAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 21301,
                "nama_prodi" => "D4-REKAYASA PERANCANGAN MEKANIK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 55555,
                "nama_prodi" => "D4-REKAYASA PERANCANGAN MEKANIK K. DEMAK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 88888,
                "nama_prodi" => "D4-REKAYASA PERANCANGAN MEKANIK K. DEMAK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 22313,
                "nama_prodi" => "D4-TEKNIK INFRASTRUKTUR SIPIL DAN PERANCANGAN ARS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 20305,
                "nama_prodi" => "D4-TEKNIK LISTRIK INDUSTRI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 24305,
                "nama_prodi" => "D4-TEKNOLOGI REKAYASA KIMIA INDUSTRI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 36305,
                "nama_prodi" => "D4-TEKNOLOGI REKAYASA KONTRUKSI PERKAPALAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 2,
                "kode_prodi" => 36304,
                "nama_prodi" => "D4-TEKNOLOGI REKAYASA OTOMASI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 3,
                "kode_prodi" => 62901,
                "nama_prodi" => "PP-PROGRAM PROFESI AKUNTANSI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 3,
                "kode_prodi" => 11901,
                "nama_prodi" => "PP-PROGRAM PROFESI DOKTER",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 3,
                "kode_prodi" => 12901,
                "nama_prodi" => "PP-PROGRAM PROFESI DOKTER GIGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 3,
                "kode_prodi" => 45901,
                "nama_prodi" => "PP-PROGRAM PROFESI FISIKAWAN MEDIK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 3,
                "kode_prodi" => 23902,
                "nama_prodi" => "PP-PROGRAM PROFESI INSINYUR",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 3,
                "kode_prodi" => 14901,
                "nama_prodi" => "PP-PROGRAM PROFESI NERS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 63111,
                "nama_prodi" => "S2-ADMINISTRASI BISNIS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 63101,
                "nama_prodi" => "S2-ADMINISTRASI PUBLIK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 5,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 54101,
                "nama_prodi" => "S2-AGRIBISNIS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 62101,
                "nama_prodi" => "S2-AKUNTANSI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 23101,
                "nama_prodi" => "S2-ARSITEKTUR",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 46101,
                "nama_prodi" => "S2-BIOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 60101,
                "nama_prodi" => "S2-EKONOMI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 12,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 21102,
                "nama_prodi" => "S2-ENERGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 12,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 13121,
                "nama_prodi" => "S2-EPIDEMIOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 45101,
                "nama_prodi" => "S2-FISIKA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 1,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 74101,
                "nama_prodi" => "S2-HUKUM",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 11106,
                "nama_prodi" => "S2-ILMU BIOMEDIS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 13111,
                "nama_prodi" => "S2-ILMU GIZI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 54141,
                "nama_prodi" => "S2-ILMU KELAUTAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 70101,
                "nama_prodi" => "S2-ILMU KOMUNIKASI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 12,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 95129,
                "nama_prodi" => "S2-ILMU LINGKUNGAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 6,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 79102,
                "nama_prodi" => "S2-ILMU LINGUISTIK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 67101,
                "nama_prodi" => "S2-ILMU POLITIK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 1,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 74102,
                "nama_prodi" => "S2-KENOTARIATAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 14101,
                "nama_prodi" => "S2-KEPERAWATAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 8,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 13151,
                "nama_prodi" => "S2-KESEHATAN LINGKUNGAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 8,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 13101,
                "nama_prodi" => "S2-KESEHATAN MASYARAKAT",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 47102,
                "nama_prodi" => "S2-KIMIA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 61101,
                "nama_prodi" => "S2-MANAJEMEN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 54142,
                "nama_prodi" => "S2-MANAJEMEN SUMBER DAYA PERAIRAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 44101,
                "nama_prodi" => "S2-MATEMATIKA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 95103,
                "nama_prodi" => "S2-PERENCANAAN WILAYAH DAN KOTA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 5,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 54131,
                "nama_prodi" => "S2-PETERNAKAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 8,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 13131,
                "nama_prodi" => "S2-PROMOSI KESEHATAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 11,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 73101,
                "nama_prodi" => "S2-PSIKOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 6,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 80101,
                "nama_prodi" => "S2-SEJARAH",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 12,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 57101,
                "nama_prodi" => "S2-SISTEM INFORMASI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 6,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 79101,
                "nama_prodi" => "S2-SUSASTRA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 26101,
                "nama_prodi" => "S2-TEKNIK DAN MANAJEMEN INDUSTRI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 20101,
                "nama_prodi" => "S2-TEKNIK ELEKTRO",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 24101,
                "nama_prodi" => "S2-TEKNIK KIMIA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 25101,
                "nama_prodi" => "S2-TEKNIK LINGKUNGAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 21101,
                "nama_prodi" => "S2-TEKNIK MESIN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 4,
                "kode_prodi" => 22101,
                "nama_prodi" => "S2-TEKNIK SIPIL",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 63001,
                "nama_prodi" => "S3-ADMINISTRASI PUBLIK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 2,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 60001,
                "nama_prodi" => "S3-EKONOMI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 1,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 74001,
                "nama_prodi" => "S3-HUKUM",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 23001,
                "nama_prodi" => "S3-ILMU ARSITEKTUR DAN PERKOTAAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 11001,
                "nama_prodi" => "S3-ILMU KEDOKTERAN DAN KESEHATAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 54041,
                "nama_prodi" => "S3-ILMU KELAUTAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 12,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 95029,
                "nama_prodi" => "S3-ILMU LINGKUNGAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 68001,
                "nama_prodi" => "S3-ILMU SOSIAL",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 22001,
                "nama_prodi" => "S3-ILMU TEKNIK SIPIL",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 8,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 13001,
                "nama_prodi" => "S3-KESEHATAN MASYARAKAT",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 10,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 54042,
                "nama_prodi" => "S3-MANAJEMEN SUMBER DAYA PERAIRAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 35001,
                "nama_prodi" => "S3-PERENCANAAN WILAYAH DAN KOTA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 5,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 54031,
                "nama_prodi" => "S3-PETERNAKAN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 9,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 44003,
                "nama_prodi" => "S3-SAINS DAN MATEMATIKA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 7,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 80001,
                "nama_prodi" => "S3-SEJARAH",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 12,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 55002,
                "nama_prodi" => "S3-SISTEM INFORMASI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 24001,
                "nama_prodi" => "S3-TEKNIK KIMIA",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 3,
                "departemens_id" => NULL,
                "stratas_id" => 5,
                "kode_prodi" => 21001,
                "nama_prodi" => "S3-TEKNIK MESIN",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11706,
                "nama_prodi" => "PPDS-ANESTESIOLOGI DAN TERAPI INTENSIF",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11707,
                "nama_prodi" => "PPDS-BEDAH",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11729,
                "nama_prodi" => "PPDS-BEDAH SARAF",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11704,
                "nama_prodi" => "PPDS-DERMATOLOGI DAN VENEREOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 13701,
                "nama_prodi" => "PPDS-GIZI KLINIS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11715,
                "nama_prodi" => "PPDS-JANTUNG DAN PEMBULUH DARAH",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11721,
                "nama_prodi" => "PPDS-KEDOKTERAN FISIK DAN REHABILITASI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11710,
                "nama_prodi" => "PPDS-KEDOKTERAN FORENSIK DAN STUDI MEDIKOLEGAL",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11711,
                "nama_prodi" => "PPDS-KESEHATAN ANAK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11725,
                "nama_prodi" => "PPDS-MIKROBIOLOGI KLINIS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11703,
                "nama_prodi" => "PPDS-NEUROLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11708,
                "nama_prodi" => "PPDS-OBSTETRI DAN GINEKOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11701,
                "nama_prodi" => "PPDS-OPHTHALMOLOGY",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11718,
                "nama_prodi" => "PPDS-PATOLOGI ANATOMIK",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11719,
                "nama_prodi" => "PPDS-PATOLOGI KLINIS",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11702,
                "nama_prodi" => "PPDS-PENYAKIT DALAM",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11724,
                "nama_prodi" => "PPDS-PSIKIATRI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11723,
                "nama_prodi" => "PPDS-RADIOLOGI",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 6,
                "kode_prodi" => 11705,
                "nama_prodi" => "PPDS-TELINGA,HIDUNG,TENGGOROK,KEPALA DAN LEHER",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 7,
                "kode_prodi" => 11732,
                "nama_prodi" => "PPDSS-BEDAH",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 4,
                "departemens_id" => NULL,
                "stratas_id" => 7,
                "kode_prodi" => 11734,
                "nama_prodi" => "PPDSS-PENYAKIT DALAM",
                "status" => 1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 9,
                "kode_prodi" => 61403,
                "nama_prodi" => "D3-ADMINISTRASI PAJAK K. BATANG",
                "status" => 0,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 9,
                "kode_prodi" => 62401,
                "nama_prodi" => "D3-AKUNTANSI K. PEKALONGAN",
                "status" => 0,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 9,
                "kode_prodi" => 68401,
                "nama_prodi" => "D3-HUBUNGAN MASYARAKAT K. BATANG",
                "status" => 0,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 9,
                "kode_prodi" => 61413,
                "nama_prodi" => "D3-MANAJEMEN K. REMBANG",
                "status" => 0,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "fakultass_id" => 13,
                "departemens_id" => NULL,
                "stratas_id" => 9,
                "kode_prodi" => 35403,
                "nama_prodi" => "D3-PERENCANAAN TATA RUANG WILAYAH DAN KOTA K. PEKALONGAN",
                "status" => 0,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ]

        ];
        Programstudi::insert($data);


    }
}
