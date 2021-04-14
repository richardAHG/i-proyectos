<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\proyecto;

use app\modules\v1\constants\Params as ConstantsParams;
use app\modules\v1\models\clases\Archivos;
use app\modules\v1\models\clases\ProyectoArchivo;
use app\modules\v1\models\clases\ProyectoInformacion;
use app\rest\Action;
use Exception;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Elimina un proyecto.
 *
 * Elinacion logica del proyecto, del logo y de la asignacion del usuario.
 *
 * @author Richard Huamán <richard21hg92@gmail.com>
 * 
 */
class DeleteAction extends Action
{
    /**
     * Deletes a model.
     * @param mixed $id id of the model to be deleted.
     * @throws ServerErrorHttpException on failure.
     */
    public function run($id)
    {
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }


        $transaction = Yii::$app->db->beginTransaction();
        try {

            $model->estado = false;
            $model->eliminado_por = ConstantsParams::getAudit();

            if (!$model->save()) {
                throw new BadRequestHttpException("Error al eliminar el proyecto");
            }
            // Eliminar información del proyecto
            ProyectoInformacion::eliminar($model->id);

            // Eliminar asignación del proyecto_archivo
            $archivoId = ProyectoArchivo::eliminar($model->id);

            // Eliminar archivo asignado al proyecto
            Archivos::elimnar($archivoId);

            $transaction->commit();
        } catch (Exception $ex) {
            $transaction->rollBack();
            throw $ex;
        }
        return $model;
    }
}
