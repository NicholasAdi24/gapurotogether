<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class, //
            StrataSeeder::class,
            FakultasSeeder::class,
            RoleSeeder::class, //
            UserroleSeeder::class, //
            ProgramstudiSeeder::class,
            LembagaSeeder::class,
            SpmiperiodeSeeder::class,
            SpmielemenSeeder::class,
            SpmiindikatorSeeder::class,
            SpmibobotSeeder::class,
            SpmiindikatorsubSeeder::class,
            SpmiindikatorkualitatifSeeder::class,
            SpmiindikatorkomponenSeeder::class,
            SpmikategorijenistemuanSeeder::class,
            SpmipenilaianprodiSeeder::class,
            SpmiPenilaianIndikatorsSeeder::class,
            SpmiPindikatorKomponensSeeder::class,
            SpmiPenilaianIndikatorsCalcSeeder::class,
            UserprogramstudiSeeder::class,
            UserprogramstudiAuditorSeeder::class,
            SpmeakreditasiSeeder::class,
            UsersFakultasSeeder::class, //
        ]);
    }
}
