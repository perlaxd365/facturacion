<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            [
                'id' => '01',
                'description' => 'Factura',
            ],
            [
                'id' => '03',
                'description' => 'Boleta de Venta',
            ],
            [
                'id' => '07',
                'description' => 'Nota de Crédito',
            ],
            [
                'id' => '08',
                'description' => 'Nota de Débito',
            ],
            [
                'id' => '09',
                'description' => 'Guía de Remisión Remitente',
            ],
            [
                'id' => '12',
                'description' => 'Ticket de maquina registradora',
            ],
            [
                'id' => '31',
                'description' => 'Guía de Remisión Transportista',
            ],
            
        ];

        foreach ($documents as $document) {
            \App\Models\Document::create($document);
        }
    }
}
