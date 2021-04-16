<?php

return [
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'proyecto' => 'v1/proyecto'
        ],
        'extraPatterns' => [
            'POST {id}' => 'updateproyecto',
        ],
        'prefix'=>'/v1/<usuario_id:\\d>'
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'etapa' => 'v1/etapa'
        ],
        'prefix'=>'/v1/<proyecto_id:\\d>'
    ],
];