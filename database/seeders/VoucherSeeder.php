<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vouchers = [
            [
                'name' => 'Factura Eléctronica',
                'document_id' => '01',
            ],
            [
                'name' => 'Boleta de Venta Electrónica',
                'document_id' => '03',
            ],
            [
                'name' => 'Nota de Crédito que modifica una Factura',
                'document_id' => '07',
            ],
            [
                'name' => 'Nota de Débito que modifica una Factura',
                'document_id' => '08',
            ],
            [
                'name' => 'Nota de Crédito que modifica una Boleta',
                'document_id' => '07',
            ],
            [
                'name' => 'Nota de Débito que modifica una Boleta',
                'document_id' => '08',
            ],
            [
                'name' => 'Guía de Remisión',
                'document_id' => '09',
            ]
        ];

        foreach ($vouchers as $voucher) {
            \App\Models\Voucher::create([
                'name' => $voucher['name'],
                'document_id' => $voucher['document_id']
            ]);
        }
    }
}
