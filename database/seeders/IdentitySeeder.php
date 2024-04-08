<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $identities = [
            [
                'id' => '-',
                'description' => 'Sin documento',
            ],
            [
                'id' => '0',
                'description' => 'Doc. trib. (no domiciliado)',
            ],
            [
                'id' => '1',
                'description' => 'DNI',
            ],
            [
                'id' => '4',
                'description' => 'Carnet de extranjeria',
            ],
            [
                'id' => '6',
                'description' => 'RUC',
            ],
            [
                'id' => '7',
                'description' => 'Pasaporte',
            ],
            [
                'id' => 'A',
                'description' => 'Cedula Diplomatica',
            ],
            [
                'id' => 'B',
                'description' => 'Doc. Ident. pais residencia-no dom.',
            ],
            [
                'id' => 'C',
                'description' => 'TIN -Tax Identification Number',
            ],
            [
                'id' => 'D',
                'description' => 'IN - Identification Number',
            ],
            [
                'id' => 'E',
                'description' => 'TAM - Tarjeta Andina de Migración'
            ]
        ];

        foreach ($identities as $identity) {
            \App\Models\Identity::create($identity);
        }
    }
}
