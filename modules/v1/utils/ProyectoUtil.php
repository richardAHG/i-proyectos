<?php

namespace app\modules\v1\utils;

use app\helpers\File;
use app\helpers\Params;
use app\modules\v1\models\clases\Archivos;
use app\modules\v1\models\clases\ProyectoArchivo;
use app\modules\v1\models\ProyectoArchivosModel;
use app\modules\v1\models\query\ArchivoQuery;
use yii\web\BadRequestHttpException;

class ProyectoUtil
{
    public static function loadFile($proyecto_id, $file)
    {
        File::validate($file);
        //obtiene ruta + nombre del archivo
        $nuevoNombre = File::getPath() . "/" . File::generateNameFile();

        //mueve el documento de temp al directorio destino
        File::upload($file, $nuevoNombre);

        //Registra datos del documento en tabla archivos
        $archivo = Archivos::insertar($file, $nuevoNombre);

        ProyectoArchivo::insertar($proyecto_id, $archivo);
    }
}
