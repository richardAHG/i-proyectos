<?php

namespace app\modules\v1\constants;

use app\helpers\Date;

class Params
{
    private static $proyectoId = 1;
    private static $userId = 1;
    private static $userIdCron = 100;

    public static function getProyectoId()
    {
        return self::$proyectoId;
    }

    public static function getUserId()
    {
        return self::$userId;
    }

    public static function getUserIdCron()
    {
        return self::$userIdCron;
    }

    public static function getAudit()
    {
        $date = Date::getDateTime();
        $usuario = self::$userId;
        return "({$date},{$usuario})";
    }

}
