<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SyncService;
use Automattic\WooCommerce\Client;

class WooCommerceController extends Controller
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
            $message    = "Se han encontrado " . count($data) . " $entity.\n";

            $rows       = $this->syncService->syncToSap($data, $entity);

            $successCount   = 0;
            $errorCount     = 0;
            $errorDetails   = [];

            foreach ($rows as $row) {
                if ($row['hasError']) {
                    $errorCount++;
                    $errorDetails[] = $row['message'];
                } else {
                    $successCount++;
                }
            }

            $message .= "Sincronización completada: $successCount $entity sincronizados exitosamente y $errorCount con errores.\n";

            if ($errorCount > 0) {
                $message .= "Detalles de los errores:\n" . implode("\n", $errorDetails);
            }

            return response()->json([
                'success'       => true,
                'message'       => $message,
                'count'         => count($data),
                'data'          => $data,
                'successCount'  => $successCount,
                'errorCount'    => $errorCount,
                'errorDetails'  => $errorDetails,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        try {
            $data       = $this->getData($entity);
            $message    = "Se han encontrado " . count($data) . " $entity.\n";

            $this->syncService->syncToSap($data, $entity);

            $message .= " Sincronizando $entity... $entity sincronizados exitosamente.";

            return response()->json([
                'success'   => true,
                'message'   => $message,
                'count'     => count($data),
                'data'      => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Obtener datos de WooCommerce.
     */
    private function getData(String $endpoint)
    {
        $woocommerce = new Client(
            config('woocommerce.api_url'),
            config('woocommerce.consumer_key'),
            config('woocommerce.consumer_secret'),
            [
                'version'     => 'wc/v3',
                'verify_ssl'  => config('woocommerce.verify_ssl'),
            ]
        );

        $response       = [];
        $page           = 1;
        $fieldsRequired = config("woocommerce.$endpoint");

        do {
            $data   = (array)$woocommerce->get($endpoint, [
                'per_page'  => 100,
                'page'      => $page,
                'fields'    => $fieldsRequired,
            ]);

            $filteredData   = $this->filterFields($data, $fieldsRequired);
            $response       = array_merge($response, $filteredData);
            $page++;
        } while (count($data) > 0);

        return $response;
    }

    /**
     * Filtrar los campos requeridos.
     */
    private function filterFields(array $data, array $fieldsRequired)
    {
        return array_map(function ($item) use ($fieldsRequired) {
            return array_intersect_key((array) $item, array_flip($fieldsRequired));
        }, $data);
    }
}

