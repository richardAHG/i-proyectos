<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=;port=;dbname=',
    'username' => '',
    'password' => '',
    'charset' => 'utf8',
    'on afterOpen' => function ($event) {
        $event->sender->createCommand("SET timezone='America/Lima';")->execute();
    },
];
