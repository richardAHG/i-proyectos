<?php

namespace app\modules\v1\models\query;

use app\modules\v1\models\ProyectoEtapasModel;
use yii\web\ServerErrorHttpException;

class EtapaQuery
{
    public static function validateDuplicate($nombre, $proyectoId, $id = null)
    {
        $etapaModel = ProyectoEtapasModel::find()
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
