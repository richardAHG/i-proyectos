<?php

namespace app\modules\v1\models\clases;

use app\modules\v1\models\ProyectoArchivosModel;
use yii\web\ServerErrorHttpException;

class ProyectoArchivo
{
    public static function insertar($proyecto_id, $archivo_id)
    {
        $model = new ProyectoArchivosModel();
        $model->proyecto_id = $proyecto_id;
        $model->archivo_id = $archivo_id;

        if (!$model->save()) {
            throw new ServerErrorHttpException('Error al insertar en proyecto archivo.');
        }
    }
}
