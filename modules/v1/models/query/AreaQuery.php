<?php

namespace app\modules\v1\models\query;

use app\modules\v1\models\ProyectoAreasModel;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;

class AreaQuery
{
    public static function validateDuplicate($nombre, $proyectoId, $id = null)
    {
        $etapaModel = ProyectoAreasModel::find()
            ->where([
                'estado' => true,
                'proyecto_id' => $proyectoId,
                'upper(nombre)' => mb_strtoupper($nombre),
            ]);
        if (isset($id)) {
            $etapaModel->andWhere(['NOT', ['id' => $id]]);
        }
        $rpta = $etapaModel->one();

        if (isset($rpta)) {
            throw new ServerErrorHttpException('La Etapa ya existe, ingrese otros datos');
        }
    }
}
