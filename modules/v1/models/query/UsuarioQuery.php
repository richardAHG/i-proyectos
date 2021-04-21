<?php

namespace app\modules\v1\models\query;

use app\modules\v1\models\ProyectosModel;
use app\modules\v1\models\UsuariosModel;
use yii\web\BadRequestHttpException;

class UsuarioQuery
{
    public static function validateUsuario($usuarioId)
    {
        $model = UsuariosModel::find()
            ->where([
                'estado' => true,
                'id' => $usuarioId
            ])->one();

        if (!$model) {
            throw new BadRequestHttpException("No existe el usuario");
        }
        return $model;
    }

    public static function ValidateUserProject($usuarioId, $proyectoId)
    {
        $model = ProyectosModel::findOne(['id' => $proyectoId, 'usuario_id' => $usuarioId]);

        if (!$model) {
            throw new BadRequestHttpException("EL proyecto no pertence al usuario");
        }
    }
}
