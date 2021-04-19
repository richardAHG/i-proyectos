<?php

namespace app\modules\v1\models\query;

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
}
