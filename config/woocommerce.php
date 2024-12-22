<?php

return [
    'api_url'           => env('WOOCOMMERCE_API_URL', ''),
    'consumer_key'      => env('WOOCOMMERCE_CONSUMER_KEY', ''),
    'consumer_secret'   => env('WOOCOMMERCE_CONSUMER_SECRET', ''),
    'verify_ssl'        => env('WOOCOMMERCE_VERIFY_SSL', true),
    'products'          => [
        'id',
        'sku',
        'name',
        'type',
        'description',
        'short_description',
        'images',
        'stock_quantity',
        'stock_status',
        'backorders',
        'low_stock_amount',
        'regular_price',
        'sale_price',
        'tax_class',
        'tax_status',
        'categories',
        'tags',
        'attributes'
    ],
    'orders'            => [
        'id',
        'date_created',
        'status',
        'payment_method',
        'transaction_id',
        'total',
        'shipping_total',
        'total_tax',
        'line_items'
    ],
    'customers'         => [
        'id',
        'billing',
        'shipping',
        'email',
        'phone',
        'meta_data'
    ]
];
