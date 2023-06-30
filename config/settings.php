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
    ],

    'default_is_pending' => env('IS_PENDING_DEFAULT', true),
    'is_pending' => [
        'true' => true,
        'false' => false
    ],

    'default_is_approved' => env('IS_APPROVED_DEFAULT', false),
    'is_approved' => [
    'true' => true,
    'false' => false
    ]
];
