<?php

namespace app\modules\v1\models\clases;

use app\helpers\File;
use app\modules\v1\constants\Params;
use app\modules\v1\models\ArchivosModel;
use yii\web\ServerErrorHttpException;

class Archivos
{
    public static function insertar($file, $nombreArchivo)
    {
        $ext = explode('.', $file->name);
        $model = new ArchivosModel();
        $model->ruta = $nombreArchivo;
        $model->tipo = $file->type;
        $model->peso = $file->size;
        $model->nombre = $file->getBaseName();
        $model->extension =  end($ext);

        if (!$model->save()) {
            throw new ServerErrorHttpException('Error al guardar en archivo');
        }

        return $model->id;
    }

    public static function elimnar($archivoId)
    {
        $model = ArchivosModel::find()
            ->where(['estado' => true, 'id' => $archivoId])
            ->one();

        $model->estado = false;
        
        if (!$model->save()) {
            throw new ServerErrorHttpException('Error al eliminar en archivo');
        }

        return $model->id;
    }
}
