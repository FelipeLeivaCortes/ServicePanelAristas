<?php

namespace App\Services;

use Automattic\WooCommerce\Client;
use Illuminate\Support\Facades\Http;

class SyncService
{
    protected $sapBaseUrl;
    protected $sapApiKey;
    protected $woocommerceBaseUrl;

    public function __construct()
    {
        $this->sapBaseUrl   = config('sap.api_url');
        $this->sapApiKey    = config('sap.api_key');
    }

    /**
     * Sincronizar datos con la API de SAP.
     */
    public function syncToSap(array $data, string $endpoint)
    {
        $response = [];

        foreach ($data as $index => $row) {
            $hasError = random_int(0, 1);

            $message = $hasError
                ? "Error en la sincronización. El Item en la posición $index tiene un problema."
                : "Sincronización exitosa para el Item en la posición $index.";

            $response[] = [
                'index'     => $index,
                'row'       => $row,
                'hasError'  => $hasError,
                'message'   => $message,
            ];
        }

        return $response;
    }

    /**
     * Sincronizar datos con la API de WooCommerce.
     */
    public function syncToWooCommerce(array $data, string $endpoint)
    {
        $responses = [];

        $woocommerce = new Client(
            config('woocommerce.api_url'),
            config('woocommerce.consumer_key'),
            config('woocommerce.consumer_secret'),
            [
                'version'     => 'wc/v3',
                'verify_ssl'  => config('woocommerce.verify_ssl'),
            ]
        );

        foreach ($data as $index => $item) {
            try {
                $existingResource = $woocommerce->get($endpoint, ['id' => $item['id'] ?? null]);

                if (!empty($existingResource)) {
                    $resourceId = $existingResource[0]->id;
                    $response   = $woocommerce->put("{$endpoint}/{$resourceId}", $item);
                    $message    = "Sincronización exitosa para el Item en la posición $index (actualizado).";
                } else {
                    $response   = $woocommerce->post($endpoint, $item);
                    $message    = "Sincronización exitosa para el Item en la posición $index (creado).";
                }

                $responses[] = [
                    'index'     => $index,
                    'row'       => $item,
                    'hasError'  => false,
                    'message'   => $message,
                    'response'  => $response,
                ];

            } catch (\Exception $e) {
                $responses[] = [
                    'index'     => $index,
                    'row'       => $item,
                    'hasError'  => true,
                    'message'   => "Error en la sincronización para el Item en la posición $index:\n" . $e->getMessage(),
                ];
            }
        }

        return $responses;
    }

}