<?php

return [
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'proyecto' => 'v1/proyecto'
        ],
        'tokens' => [
            '{proyecto_id}' => '<proyecto_id:\\d+>',
            '{area_id}' => '<area_id:\\d+>',
            '{id}' => '<id:\\d+>',
        ],
        'extraPatterns' => [
            'POST {id}' => 'updateproyecto',

            'POST {proyecto_id}/area' => 'areaCreate',
            'PUT {proyecto_id}/area/{id}' => 'areaUpdate',
            'DELETE {proyecto_id}/area/{id}' => 'areaDelete',
            'GET {proyecto_id}/area' => 'areaIndex',
            'GET {proyecto_id}/area/{id}' => 'areaView',

            'POST {proyecto_id}/area/{area_id}/colaborador' => 'areaColaboradorCreate',
            'DELETE {proyecto_id}/area/{area_id}/colaborador/{id}' => 'areaColaboradorDelete',
            'GET {proyecto_id}/area/{area_id}/colaborador' => 'areaColaboradorIndex',
            'GET {proyecto_id}/area/{area_id}/colaborador/{id}' => 'areaColaboradorView',

            'POST {proyecto_id}/etapa' => 'etapaCreate',
            'PUT {proyecto_id}/etapa/{id}' => 'etapaUpdate',
            'DELETE {proyecto_id}/etapa/{id}' => 'etapaDelete',
            'GET {proyecto_id}/etapa' => 'etapaIndex',
            'GET {proyecto_id}/etapa/{id}' => 'etapaView',

            'POST {proyecto_id}/colaborador' => 'colaboradorCreate',
            'GET {proyecto_id}/colaborador/aceptar' => 'colaboradorAceptado',
            'GET {proyecto_id}/colaborador' => 'colaboradorIndex',
            'GET {proyecto_id}/colaborador/{id}' => 'colaboradorView',
            'DELETE {proyecto_id}/colaborador/{id}' => 'colaboradorDelete',
            
        ],
        'prefix' => '/v1/<usuario_id:\\d>'
    ],
    // [
    //     'class' => 'yii\rest\UrlRule',
    //     'pluralize' => false,
    //     'controller' => [
    //         'etapa' => 'v1/etapa'
    //     ],
    //     'prefix' => '/v1/<proyecto_id:\\d>'
    // ],
];
