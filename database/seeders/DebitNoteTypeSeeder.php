<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebitNoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'code' => '01',
                'description' => 'Intereses por mora'
            ],
            [
                'code' => '02',
                'description' => 'Aumento en el valor'
            ],
            [
                'code' => '03',
                'description' => 'Penalidades/ otros conceptos'
            ],
            [
                'code' => '10',
                'description' => 'Ajustes de operaciones de exportación'
            ],
            [
                'code' => '11',
                'description' => 'Ajustes afectos al IVAP'
            ]
        ];


        foreach ($types as $type) {
            \App\Models\DebitNoteType::create($type);
        }

    }
}
