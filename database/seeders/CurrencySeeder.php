<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'id' => 'PEN',
                'description' => '(S/) Sol',
                'order' => 1
            ],
            [
                'id' => 'USD',
                'description' => '($/.) Dólar EEUU',
                'order' => 2
            ],
            [
                'id' => 'EUR',
                'description' => '(€) Euro',
                'order' => 3
            ],
            [
                'id' => 'ARS',
                'description' => '(ARS) Peso Argentino',
                'order' => 4
            ],
            [
                'id' => 'BOB',
                'description' => '(Bs) Boliviano',
                'order' => 5
            ],
            [
                'id' => 'BRL',
                'description' => '(R$) Real',
                'order' => 6
            ],
            [
                'id' => 'CLP',
                'description' => '(CLP) Peso Chileno',
                'order' => 7
            ],
            [
                'id' => 'COP',
                'description' => '(COP) Peso Colombiano',
                'order' => 8
            ],
            [
                'id' => 'MXN',
                'description' => '(MXN) Peso Mexicano',
                'order' => 9
            ]
        ];

        foreach ($currencies as $currency) {
            \App\Models\Currency::create($currency);
        }
    }
}
