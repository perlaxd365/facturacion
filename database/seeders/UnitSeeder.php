<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'id' => 'NIU',
                'description' => 'Unidad (unidad)',
                'order' => 1,
            ],
            [
                'id' => 'ZZ',
                'description' => 'Unidad de servicio',
                'order' => 2,
            ],
            [
                'id' => '4A',
                'description' => 'Bobinas',
                'order' => 3,
            ],
            [
                'id' => 'BJ',
                'description' => 'Balde',
                'order' => 4,
            ],

            [
                'id' => 'BLL',
                'description' => 'Barriles',
                'order' => 5,
            ],
            [
                'id' => 'BG',
                'description' => 'Bolsa',
                'order' => 6,
            ],

            [
                'id' => 'BO',
                'description' => 'Botellas',
                'order' => 7,
            ],

            [
                'id' => 'BX',
                'description' => 'Caja',
                'order' => 8,
            ],

            [
                'id' => 'CT',
                'description' => 'Cartones',
                'order' => 9,
            ],

            [
                'id' => 'CMK',
                'description' => 'Centimetro cuadrado',
                'order' => 10,
            ],

            [
                'id' => 'CMQ',
                'description' => 'Centimetro cubico',
                'order' => 11,
            ],

            [
                'id' => 'CMT',
                'description' => 'Centimetro lineal',
                'order' => 12,
            ],

            [
                'id' => 'CEN',
                'description' => 'Cien unidades',
                'order' => 13,
            ],

            [
                'id' => 'CY',
                'description' => 'Cilindro',
                'order' => 14,
            ],

            [
                'id' => 'CJ',
                'description' => 'Conos',
                'order' => 15,
            ],

            [
                'id' => 'DZN',
                'description' => 'Docena',
                'order' => 16,
            ],

            [
                'id' => 'DZP',
                'description' => 'Docena por 10**6',
                'order' => 17,
            ],

            [
                'id' => 'BE',
                'description' => 'Fardo',
                'order' => 18,
            ],

            [
                'id' => 'GLI',
                'description' => 'Galones (EUA)',
                'order' => 19,
            ],

            [
                'id' => 'GRM',
                'description' => 'Gramo',
                'undPeso' => true,
                'order' => 20,
            ],

            [
                'id' => 'GRO',
                'description' => 'Gruesa',
                'order' => 21,
            ],

            [
                'id' => 'HLT',
                'description' => 'Hectolitro',
                'order' => 22,
            ],

            [
                'id' => 'LEF',
                'description' => 'Hoja',
                'order' => 23,
            ],

            [
                'id' => 'SET',
                'description' => 'Juego',
                'order' => 24,
            ],

            [
                'id' => 'KGM',
                'description' => 'Kilogramo',
                'undPeso' => true,
                'order' => 25,
            ],

            [
                'id' => 'KTM',
                'description' => 'Kilometro',
                'order' => 26,
            ],

            [
                'id' => 'KWH',
                'description' => 'Kilovatio-hora',
                'order' => 27,
            ],

            [
                'id' => 'KT',
                'description' => 'Kit',
                'order' => 28,
            ],

            [
                'id' => 'CA',
                'description' => 'Latas',
                'order' => 29,
            ],

            [
                'id' => 'LBR',
                'description' => 'Libras',
                'order' => 30,
            ],

            [
                'id' => 'LTR',
                'description' => 'Litro',
                'order' => 31,
            ],

            [
                'id' => 'MWH',
                'description' => 'Megawatt-hora',
                'order' => 32,
            ],

            [
                'id' => 'MTR',
                'description' => 'Metro',
                'order' => 33,
            ],

            [
                'id' => 'MTK',
                'description' => 'Metro cuadrado',
                'order' => 34,
            ],

            [
                'id' => 'MTQ',
                'description' => 'Metro cubico',
                'order' => 35,
            ],

            [
                'id' => 'MGM',
                'description' => 'Miligramo',
                'order' => 36,
            ],

            [
                'id' => 'MLT',
                'description' => 'Mililitro',
                'order' => 37,
            ],

            [
                'id' => 'MMT',
                'description' => 'Milimetro',
                'order' => 38,
            ],
            
            [
                'id' => 'MMK',
                'description' => 'Milimetro cuadrado',
                'order' => 39,
            ],

            [
                'id' => 'MMQ',
                'description' => 'Milimetro cubico',
                'order' => 40,
            ],

            [
                'id' => 'MIL',
                'description' => 'Millares',
                'order' => 41,
            ],

            [
                'id' => 'UM',
                'description' => 'Millones de unidades internacionales',
                'order' => 42,
            ],

            [
                'id' => 'ONZ',
                'description' => 'Onzas',
                'order' => 43,
            ],

            [
                'id' => 'PF',
                'description' => 'Paletas',
                'order' => 44,
            ],

            [
                'id' => 'PK',
                'description' => 'Paquete',
                'order' => 45,
            ],

            [
                'id' => 'PR',
                'description' => 'Par',
                'order' => 46,
            ],

            [
                'id' => 'FOT',
                'description' => 'Pies',
                'order' => 47,
            ],

            [
                'id' => 'FTK',
                'description' => 'Pies cuadrados',
                'order' => 48,
            ],

            [
                'id' => 'FTQ',
                'description' => 'Pies cubicos',
                'order' => 49,
            ],

            [
                'id' => 'C62',
                'description' => 'Piezas',
                'order' => 50,
            ],

            [
                'id' => 'PG',
                'description' => 'Placas',
                'order' => 51,
            ],

            [
                'id' => 'ST',
                'description' => 'Pliego',
                'order' => 52,
            ],

            [
                'id' => 'INH',
                'description' => 'Pulgadas',
                'order' => 53,
            ],

            [
                'id' => 'RM',
                'description' => 'Resma',
                'order' => 54,
            ],

            [
                'id' => 'DR',
                'description' => 'Tambor',
                'order' => 55,
            ],

            [
                'id' => 'STN',
                'description' => 'Tonelada corta',
                'undPeso' => true,
                'order' => 56,
            ],

            [
                'id' => 'LTN',
                'description' => 'Tonelada larga',
                'undPeso' => true,
                'order' => 57,
            ],

            [
                'id' => 'TNE',
                'description' => 'Toneladas',
                'undPeso' => true,
                'order' => 58,
            ],

            [
                'id' => 'TU',
                'description' => 'Tubos',
                'order' => 59,
            ],
            
            [
                'id' => 'GLL',
                'description' => 'US Galon (3,7843 L)',
                'order' => 60,
            ],

            [
                'id' => 'YRD',
                'description' => 'Yarda',
                'order' => 61,
            ],

            [
                'id' => 'YDK',
                'description' => 'Yarda cuadrada',
                'order' => 62,
            ]
            
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
