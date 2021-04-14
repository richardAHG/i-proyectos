<?php

namespace app\modules\v1\models\clases;

use app\modules\v1\models\ProyectoInformacionModel;
use yii\web\ServerErrorHttpException;

class ProyectoInformacion
{
    public static function insertar($params, $proyecto_id)
    {

        $model = new ProyectoInformacionModel();
        $model->color_id = $params['color'];
        $model->descripcion = $params['descripcion'];
        $model->proyecto_id = $proyecto_id;
        if (!$model->save()) {
            throw new ServerErrorHttpException('Error al guardar la informacion del proyecto');
        }

        return $model->id;
    }

    public static function actualizar($params, $proyecto_id)
    {
        $model = ProyectoInformacionModel::find()
            ->where([
                'estado' => true,
                'proyecto_id' => $proyecto_id
            ])
            ->one();

        $model->color_id = $params['color'];
        $model->descripcion = $params['descripcion'];
        $model->proyecto_id = $proyecto_id;
        if (!$model->save()) {
            throw new ServerErrorHttpException('Error al guardar la informacion del proyecto');
        }

        return $model->id;
    }
}
