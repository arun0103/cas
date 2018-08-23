<?php

return [

    /*
    |----------------------------------------------------------------------
    | Driver Configuration
    |----------------------------------------------------------------------
    |
    | Setup your driver configuration to let us match the driver name to
    | a Model and path to migration.
    |
    */
    'drivers' => [
        'company' => [
            'model'  => App\Company::class,
            'path'   => database_path('tenanti/user'),
            'shared' => false,
        ],
        'user' =>[
            'model'=>App\User::class,
            'path'=> database_path(''),
            'shared'=>true,
        ]
    ],
];