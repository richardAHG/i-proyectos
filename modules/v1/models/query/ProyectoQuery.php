<?php

namespace app\modules\v1\models\query;

use app\modules\v1\models\ProyectosModel;
use yii\web\BadRequestHttpException;

class ProyectoQuery
{
    public static function validateDuplicate($usuarioId, $nombre)
    {
        $exist = ProyectosModel::find()
            ->where(['usuario_id' => $usuarioId])
            ->andWhere([
                'estado' => true,
                'upper(nombre)' => mb_strtoupper($nombre)
            ])
            ->one();
        if (isset($exist)) {
            throw new BadRequestHttpException("Name already exists, process canceled");
        }
    }
}
