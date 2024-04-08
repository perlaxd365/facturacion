<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreditNoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $types = [
            [
                'code' => '01',
                'description' => 'Anulación de la operación'
            ],

            [
                'code' => '02',
                'description' => 'Anulación por error en el RUC'
            ],
            [
                'code' => '03',
                'description' => 'Corrección por error en la descripción'
            ],
            [
                'code' => '04',
                'description' => 'Descuento global'
            ],
            [
                'code' => '05',
                'description' => 'Descuento por ítem'
            ],
            [
                'code' => '06',
                'description' => 'Devolución total'
            ],
            [
                'code' => '07',
                'description' => 'Devolución por ítem'
            ],
            [
                'code' => '08',
                'description' => 'Bonificación'
            ],
            [
                'code' => '09',
                'description' => 'Disminución en el valor'
            ],
            [
                'code' => '10',
                'description' => 'Otros Conceptos'
            ],
            [
                'code' => '11',
                'description' => 'Ajustes de operaciones de exportación'
            ],
            [
                'code' => '12',
                'description' => 'Ajustes afectos al IVAP'
            ]
        ];

        foreach ($types as $type) {
            \App\Models\CreditNoteType::create($type);
        }

    }
}
