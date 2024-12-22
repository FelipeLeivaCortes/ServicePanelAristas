<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SyncService;
use Illuminate\Http\Request;

class SapController extends Controller
{
    protected $syncService;

    public function __construct(SyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    /**
     * Sincronizar datos paso a paso.
     */
    public function syncStep($entity)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        try {
            $data       = $this->getData($entity);
            $message    = "Se han encontrado " . count($data) . " $entity.";

            $this->syncService->syncToSap($data, $entity);

            $message .= " Sincronizando $entity... $entity sincronizados exitosamente.";

            return response()->json([
                'success'   => true,
                'message'   => $message,
                'count'     => count($data),
                'data'      => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get the Entities's data from WooCommerce.
     */
    private function getData(String $endpoint): array
    {
        switch($endpoint) {
            case "customers":
                return [
                    [
                        "id" => 284,
                        "email" => "felipeleiva@example.com",
                        "billing" => [
                            "first_name" => "Felipe",
                            "last_name" => "Leiva",
                            "address_1" => "Calle 123",
                            "city" => "Bogotá",
                            "postcode" => "110111",
                            "country" => "CO",
                            "phone" => "3001234567"
                        ],
                        "shipping" => [
                            "first_name" => "Juan",
                            "last_name" => "Pérez",
                            "address_1" => "Calle 123",
                            "city" => "Bogotá",
                            "postcode" => "110111",
                            "country" => "CO"
                        ]
                    ],
                    [
                        "id" => 2,
                        "email" => "cliente2@example.com",
                        "billing" => [
                            "first_name" => "María",
                            "last_name" => "Gómez",
                            "address_1" => "Carrera 45",
                            "city" => "Medellín",
                            "postcode" => "050001",
                            "country" => "CO",
                            "phone" => "3109876543"
                        ],
                        "shipping" => [
                            "first_name" => "María",
                            "last_name" => "Gómez",
                            "address_1" => "Carrera 45",
                            "city" => "Medellín",
                            "postcode" => "050001",
                            "country" => "CO"
                        ]
                    ],
                    [
                        "id" => 3,
                        "email" => "cliente3@example.com",
                        "billing" => [
                            "first_name" => "Carlos",
                            "last_name" => "López",
                            "address_1" => "Avenida 10",
                            "city" => "Cali",
                            "postcode" => "760001",
                            "country" => "CO",
                            "phone" => "3204567890"
                        ],
                        "shipping" => [
                            "first_name" => "Carlos",
                            "last_name" => "López",
                            "address_1" => "Avenida 10",
                            "city" => "Cali",
                            "postcode" => "760001",
                            "country" => "CO"
                        ]
                    ]
                ];

            case "orders":
                return [
                    [
                        "id" => 58825,
                        "status" => "processing",
                        "date_created" => "2024-12-04T19:15:53",
                        "shipping_total" => "586080",
                        "total" => "7912080",
                        "total_tax" => "0",
                        "payment_method" => "woo-mercado-pago-custom",
                        "transaction_id" => "",
                        "line_items" => [
                            [
                                "id" => 6071,
                                "name" => "Cama Milán",
                                "product_id" => 54805,
                                "variation_id" => 54813,
                                "quantity" => 1,
                                "subtotal" => "3931000",
                                "total" => "3931000",
                                "sku" => "PC0201002000000159X8",
                                "price" => 3931000,
                                "image" => [
                                    "id" => 55956,
                                    "src" => "https://aristassap.kinsta.cloud/wp-content/uploads/2024/08/frente-MILAN.jpg"
                                ]
                            ],
                            [
                                "id" => 6072,
                                "name" => "Colchón Air Comfort - Doble 1.40 Mt",
                                "product_id" => 38968,
                                "variation_id" => 38969,
                                "quantity" => 1,
                                "subtotal" => "3395000",
                                "total" => "3395000",
                                "sku" => "PC0201001000000028X1",
                                "price" => 3395000,
                                "image" => [
                                    "id" => 51279,
                                    "src" => "https://aristassap.kinsta.cloud/wp-content/uploads/2023/11/AIR-COMFORT-frente-1.jpg"
                                ]
                            ]
                        ]
                    ],
                    [
                        "id" => 58824,
                        "status" => "processing",
                        "date_created" => "2024-12-04T19:07:51",
                        "shipping_total" => "0",
                        "total" => "25123007",
                        "total_tax" => "0",
                        "payment_method" => "woo-mercado-pago-custom",
                        "transaction_id" => "",
                        "line_items" => [
                            [
                                "id" => 6064,
                                "name" => "Silla Bar Siena",
                                "product_id" => 49987,
                                "variation_id" => 50076,
                                "quantity" => 3,
                                "subtotal" => "2640001",
                                "total" => "2640001",
                                "sku" => "PC02010010000002988X89",
                                "price" => 880000.33,
                                "image" => [
                                    "id" => 51490,
                                    "src" => "https://aristassap.kinsta.cloud/wp-content/uploads/2024/06/FRENTE-SIENA.jpg"
                                ]
                            ],
                            [
                                "id" => 6065,
                                "name" => "Sofá Milan",
                                "product_id" => 25079,
                                "variation_id" => 25117,
                                "quantity" => 1,
                                "subtotal" => "3500001",
                                "total" => "3500001",
                                "sku" => "PC02011000000000108X64",
                                "price" => 3500001,
                                "image" => [
                                    "id" => 25080,
                                    "src" => "https://aristassap.kinsta.cloud/wp-content/uploads/2023/08/SOFA-MILANO-8.jpg"
                                ]
                            ]
                        ]
                    ],
                    [
                        "id" => 58779,
                        "status" => "processing",
                        "date_created" => "2024-12-04T10:00:54",
                        "shipping_total" => "69000",
                        "total" => "1128000",
                        "total_tax" => "0",
                        "payment_method" => "woo-mercado-pago-custom",
                        "transaction_id" => "",
                        "line_items" => [
                            [
                                "id" => 6054,
                                "name" => "Nochero Monet - Chocolate",
                                "product_id" => 13975,
                                "variation_id" => 13987,
                                "quantity" => 1,
                                "subtotal" => "1059000",
                                "total" => "1059000",
                                "sku" => "PC0201002000000021X4",
                                "price" => 1059000,
                                "image" => [
                                    "id" => 13976,
                                    "src" => "https://aristassap.kinsta.cloud/wp-content/uploads/2023/08/1.NOCHERO-MONET-CENIZO.jpg"
                                ]
                            ]
                        ]
                    ]
                ];

            case "products":
                return [
                    [
                        "id" => 58514,
                        "name" => "Silla Comedor Florencia Mad",
                        "type" => "variable",
                        "sku" => "PC02010010000003020X",
                        "stock_status" => "instock",
                        "categories" => [
                            [
                                "id" => 509,
                                "name" => "Comedores",
                                "slug" => "comedores"
                            ],
                            [
                                "id" => 526,
                                "name" => "Sillas de comedor",
                                "slug" => "sillas-de-comedor"
                            ]
                        ],
                        "images" => [
                            [
                                "id" => 51480,
                                "src" => "https://aristassap.kinsta.cloud/wp-content/uploads/2022/12/frente-FLORENCIA.jpg",
                                "alt" => "Silla Comedor Florencia P/N de la marca Aristas vista frontal. Un diseño elegante con un asiento acolchado en tela color Dickens Cuarzo."
                            ],
                            [
                                "id" => 51479,
                                "src" => "https://aristassap.kinsta.cloud/wp-content/uploads/2022/12/34-FLORENCIA.jpg",
                                "alt" => "Silla Comedor Florencia P/N de la marca Aristas vista diagonal. Un diseño elegante con un respaldo alto y recto; patas delgadas, ligeramente inclinadas y un asiento acolchado."
                            ],
                            [
                                "id" => 51481,
                                "src" => "https://aristassap.kinsta.cloud/wp-content/uploads/2022/12/lado-FLORENCIA.jpg",
                                "alt" => "Silla Comedor Florencia P/N de la marca Aristas vista lateral. Un diseño elegante con un respaldo alto y recto; patas delgadas, ligeramente inclinadas y un asiento acolchado en tela color Dickens Cuarzo."
                            ]
                        ],
                        "attributes" => [
                            [
                                "name" => "Tiempo de entrega",
                                "options" => ["21 días hábiles"]
                            ],
                            [
                                "name" => "Medidas",
                                "options" => ["Largo: 49 Fondo: 63 Alto: 87"]
                            ],
                            [
                                "name" => "Madera y pintura",
                                "options" => ["Patas en madera Solida"]
                            ],
                            [
                                "name" => "Espuma",
                                "options" => ["Espuma de alta densidad y alta resistencia"]
                            ],
                            [
                                "name" => "Tela",
                                "options" => ["Tela de alta resistencia al desgaste"]
                            ],
                            [
                                "name" => "Certificaciones",
                                "options" => ["Maderas Reforestadas: FSC > Rainforest alliance > Espuma ISO 9001."]
                            ],
                            [
                                "name" => "Origen",
                                "options" => ["Nacional"]
                            ],
                            [
                                "name" => "Elige color de madera",
                                "options" => ["Ceniza", "Chocolate", "Escandinavo", "Jasper", "Nordico", "Olmo"]
                            ],
                            [
                                "name" => "Elige color de tela",
                                "options" => [
                                    "Nobuck Marfil", "Nobuck Marino", "London Taupe", "Belgium Crudo",
                                    "Dickens Azul Profundo", "Palatino Plata", "Victoria Crudo",
                                    "Victoria Gris Hielo", "Victoria Plomo"
                                ]
                            ]
                        ]
                    ]
                ];

            default:
                return [];
        }
    }
}
