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
        return true;
        // try {
        //     $response = Http::withHeaders([
        //         'Authorization' => 'Bearer ' . $this->sapApiKey,
        //         'Content-Type'  => 'application/json',
        //     ])->post($this->sapBaseUrl . '/' . $endpoint, $data);

        //     if ($response->failed()) {
        //         throw new \Exception('Error al sincronizar con SAP: ' . $response->body());
        //     }

        //     return $response->json();
        // } catch (\Exception $e) {
        //     throw new \Exception('Error en la sincronización con SAP: ' . $e->getMessage());
        // }
    }

    /**
     * Sincronizar datos con la API de WooCommerce.
     */
    public function syncToWooCommerce(array $data, string $endpoint)
    {
        $responses      = [];

        $woocommerce    = new Client(
            config('woocommerce.api_url'),
            config('woocommerce.consumer_key'),
            config('woocommerce.consumer_secret'),
            [
                'version'     => 'wc/v3',
                'verify_ssl'  => config('woocommerce.verify_ssl'),
            ]
        );

        foreach ($data as $item) {
            try {
                $existingResource   = $woocommerce->get($endpoint, ['id' => $item['id'] ?? null]);

                if (!empty($existingResource)) {
                    $resourceId = $existingResource[0]->id;
                    $response   = $woocommerce->put("{$endpoint}/{$resourceId}", $item);

                } else {
                    $response = $woocommerce->post($endpoint, $item);

                }

                $responses[] = [
                    'status' => 'success',
                    'data'   => $response,
                ];

            } catch (\Exception $e) {
                $responses[] = [
                    'status'  => 'error',
                    'message' => $e->getMessage(),
                    'data'    => $item,
                ];
            }
        }

        return $responses;
    }

}