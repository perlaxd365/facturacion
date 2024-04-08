<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\MockObject\Builder\Identity;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Víctor Arana',
            'email' => 'victor@codersfree.com',
            'password' => bcrypt('12345678')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Raúl Baca',
            'email' => 'perlaxd365@mail.com',
            'password' => bcrypt('bacaxd365')
        ]);

        // \App\Models\User::factory(20)->create();

        $this->call([
            DepartmentSeeder::class,
            ProvinceSeeder::class,
            DistrictSeeder::class,
            DocumentSeeder::class,
            VoucherSeeder::class,
            IdentitySeeder::class,
            OperationSeeder::class,
            CurrencySeeder::class,
            AffectationSeeder::class,
            UnitSeeder::class,
            /* CompanySeeder::class, */
            CreditNoteTypeSeeder::class,
            DebitNoteTypeSeeder::class,
            TransferReasonSeeder::class,
        ]);
    }
}
