<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=209.50.60.117;port=54443;dbname=iwasi',
    'username' => 'team_dev',
    'password' => 'Tu38L=^#rf*_H:.t',
    'charset' => 'utf8',
    'on afterOpen' => function ($event) {
        $event->sender->createCommand("SET timezone='America/Lima';")->execute();
    },
];
