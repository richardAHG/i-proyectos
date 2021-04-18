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
            '{id}' => '<id:\\d+>',
        ],
        'extraPatterns' => [
            'POST {id}' => 'updateproyecto',
            'POST {proyecto_id}/area' => 'areaCreate',
            'PUT {proyecto_id}/area/{id}' => 'areaUpdate',
            'DELETE {proyecto_id}/area/{id}' => 'areaDelete',
            'GET {proyecto_id}/area' => 'areaIndex',
            'GET {proyecto_id}/area/{id}' => 'areaView',
            'POST {proyecto_id}/colaborador' => 'colaboradorView',
        ],
        'prefix' => '/v1/<usuario_id:\\d>'
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'etapa' => 'v1/etapa'
        ],
        'prefix' => '/v1/<proyecto_id:\\d>'
    ],
];
