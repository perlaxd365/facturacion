<?php

namespace Database\Seeders;

use App\Models\TransferReason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransferReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transfers = [
            [
                'id' => '01',
                'description' => 'Venta',
                'order' => 1,
            ],
            [
                'id' => '14',
                'description' => 'Venta sujeta a confirmación del comprador',
                'order' => 2,
            ],
            [
                'id' => '02',
                'description' => 'Compra',
                'order' => 3,
            ],
            [
                'id' => '04',
                'description' => 'Traslado entre establecimientos de la misma empresa',
                'order' => 4,
            ],
            [
                'id' => '18',
                'description' => 'Traslado emisor itinerante CP',
                'order' => 5,
            ],
            [
                'id' => '08',
                'description' => 'Importación',
                'order' => 6,
            ],
            [
                'id' => '09',
                'description' => 'Exportación',
                'order' => 7,
            ],
            [
                'id' => '19',
                'description' => 'Traslado a zona primaria',
                'order' => 8,
            ],
            [
                'id' => '13',
                'description' => 'Otros',
                'order' => 9,
            ]
        ];

        foreach ($transfers as $transfer) {
            TransferReason::create($transfer);
        }
    }
}
