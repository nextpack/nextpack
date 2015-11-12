<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Driver name
    |--------------------------------------------------------------------------
    |
    | The Supported Providers:
    | - english
    | - french
    |
    */
    'default' => 'english',

    /*
    |--------------------------------------------------------------------------
    | Drivers Namespace
    |--------------------------------------------------------------------------
    |
    | The drivers namespace
    |
    */
    'namespace' => 'Nextpack\\Nextpack\\Drivers\\',

    /*
    |--------------------------------------------------------------------------
    | Drivers Configuration
    |--------------------------------------------------------------------------
    |
    | The driver configuration will be available as properties on the
    | driver instance.
    |
    */
    'drivers' => [

        'english' => [

            'format' => '%s, %s!',

        ],

        'french' => [

            'format' => '%s, %s :)',

        ],

    ],

];
