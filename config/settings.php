<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Role
    |--------------------------------------------------------------------------
    |
    | This value is the role of the user
    |
    */

    'default_role' => env('ROLE_DEFAULT', 'user'),
    'roles' => [
        'user' => 'user',
        'admin' => 'admin'
    ]
];
