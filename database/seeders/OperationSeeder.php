<?php

namespace Database\Seeders;

use App\Models\Operation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operations = [
            [
                'id' => '0101',
                'description' => 'Venta Interna (Productos / Servicios)',
                'documents' => [
                    '01' => [
                        '6'
                    ],
                    '03' => [
                        '-', '0', '1', '4', '6', '7', 'A', 'B', 'C', 'D', 'E'
                    ]
                ]
            ],

            [
                'id' => '0102',
                'description' => 'Venta Interna - Anticipos',
                'documents' => [
                    '01' => [
                        '6'
                    ],
                    '03' => [
                        '-', '0', '1', '4', '6', '7', 'A', 'B', 'C', 'D', 'E'
                    ]
                ]
            ],

            [
                'id' => '0103',
                'description' => 'Venta Interna - Itinerante',
                'documents' => [
                    '01' => [
                        '6'
                    ],
                    '03' => [
                        '-', '0', '1', '4', '6', '7', 'A', 'B', 'C', 'D', 'E'
                    ]
                ]
            ],

            [
                'id' => '0120',
                'description' => 'Venta Interna - Sujeta al IVAP',
                'documents' => [
                    '01' => [
                        '6'
                    ],
                    '03' => [
                        '-', '0', '1', '4', '6', '7', 'A', 'B', 'C', 'D', 'E'
                    ]
                ]
            ],

            [
                'id' => '0200',
                'description' => 'Exportación de Bienes',
                'documents' => [
                    '01' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ],
                    '03' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ]
                ]
            ],
            [
                'id' => '0201',
                'description' => 'Exportación de Servicios - Realizados en el país',
                'documents' => [
                    '01' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ],
                    '03' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ]
                ]
            ],

            [
                'id' => '0202',
                'description' => 'Exportación de Servicios - Hospedaje',
                'documents' => [
                    '01' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ],
                ]
            ],

            [
                'id' => '0203',
                'description' => 'Exportación de Servicios - Transporte de navieras',
                'documents' => [
                    '01' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ],
                    '03' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ]
                ]
            ],

            [
                'id' => '0204',
                'description' => 'Exportación de Servicios - Servicios a naves y aeronaves de bandera extranjera',
                'documents' => [
                    '01' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ],
                    '03' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ]
                ]
            ],

            [
                'id' => '0205',
                'description' => 'Exportación de Servicios - Paquete Turístico',
                'documents' => [
                    '01' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ],
                ]
            ],

            [
                'id' => '0206',
                'description' => 'Exportación de Servicios - Servicios complementarios al transporte de carga',
                'documents' => [
                    '01' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ],
                    '03' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ]
                ]
            ],

            [
                'id' => '0207',
                'description' => 'Exportación de Servicios - Suministro de energía eléctrica a favor de sujetos domiciliados en ZED',
                'documents' => [
                    '01' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ],
                    '03' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ]
                ]
            ],

            [
                'id' => '0208',
                'description' => 'Exportación de Servicios - Realizados parcialmente en el extranjero',
                'documents' => [
                    '01' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ],
                    '03' => [
                        '-', '0', '7', 'B', 'C', 'D'
                    ]
                ]
            ],

            [
                'id' => '1001',
                'description' => 'Operación Sujeta a Detracción',
                'documents' => [
                    '01' => [
                        '6'
                    ],
                    '03' => [
                        '-', '0', '1', '4', '6', '7', 'A', 'B', 'C', 'D', 'E'
                    ]
                ]
            ],
        ];

        foreach ($operations as $item) {

            $operation = Operation::create([
                'id' => $item['id'],
                'description' => $item['description'],
            ]);

            foreach ($item['documents'] as $document => $identities) {
                /* $operation->documents()->attach($key, ['documents' => $value]); */

                foreach ($identities as $identity) {
                    $operation->documents()->attach($document, ['identity_id' => $identity]);
                }

            }


            /* $operation->documents()->sync($item['documents']); */

        }
    }
}
