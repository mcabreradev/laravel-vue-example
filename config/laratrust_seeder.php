<?php

return [
    'role_structure' => [
        'superadmin' => [],
        'admin' => [
            'users'                => 'b,e,a,d',
            'roles'                => 'b,e,a,d',
            'permisos'             => 'b,e,a,d',
            'pedidos'              => 'b,e,a,d',
            'alertas-mapa'         => 'b,e,a,d',
            'alertas-nivel-agua'   => 'b,a,d',
            'turnos'               => 'b,e,d',
            'reclamos'             => 'b,e,a,d',
            'reclamos-agentes'     => 'b,e,a,d',
            'reclamos-areas'       => 'b,e,a,d',
            'reclamos-estados'     => 'b,e,a,d',
            'reclamos-origenes'    => 'b,e,a,d',
            'reclamos-prioridades' => 'b,e,a,d',
            'reclamos-tipos'       => 'b,e,a,d',
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'b' => 'browse',
        'r' => 'read',
        'e' => 'edit',
        'a' => 'add',
        'd' => 'delete',
    ]
];
