<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'b,r,e,a,d',
            'roles' => 'b,r,e,a,d',
            'permisos' => 'b,r,e,a,d',
            'profile' => 'r,e'
        ],
        'administrator' => [
            'users' => 'b,r,e,a,d',
            'roles' => 'b,r,e,a,d',
            'profile' => 'r,e'
        ],
        'user' => [
            'profile' => 'r,e'
        ],
    ],
    'permission_structure' => [
    ],
    'permissions_map' => [
        'b' => 'listar',
        'r' => 'ver',
        'e' => 'editar',
        'a' => 'agregar',
        'd' => 'eliminar'
    ]
];
