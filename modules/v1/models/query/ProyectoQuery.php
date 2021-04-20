<?php

namespace app\modules\v1\models\query;

use app\modules\v1\models\ProyectoColaboradoresModel;
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

    public static function validateDuplicateUpdate($usuarioId, $nombre, $proyectoId)
    {
        $exist = ProyectosModel::find()
            ->where(['usuario_id' => $usuarioId])
            ->andWhere(['NOT', ['id' => $proyectoId]])
            ->andWhere([
                'estado' => true,
                'upper(nombre)' => mb_strtoupper($nombre)
            ])
            ->one();
        if (isset($exist)) {
            throw new BadRequestHttpException("Name already exists, process canceled");
        }
    }

    public static function existProject($usuarioId, $proyectoId, $invitacionId)
    {
        $model = ProyectoColaboradoresModel::find()
            ->where([
                'estado' => true,
                'usuario_id' => $usuarioId,
                'proyecto_id' => $proyectoId,
                'invitacion_id' => $invitacionId
            ])
            ->one();
        return $model;
    }
}
