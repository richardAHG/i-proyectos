<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\proyecto;

use app\modules\v1\constants\Params;
use app\modules\v1\models\clases\Archivos;
use app\modules\v1\models\clases\ProyectoArchivo;
use app\modules\v1\models\clases\ProyectoInformacion;
use app\modules\v1\models\query\ProyectoQuery;
use app\modules\v1\utils\ProyectoUtil;
use app\rest\Action;
use Exception;
use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

/**
 * Actualiza un proyecto.
 *
 * Actualiza informacion de un proyecto.
 *
 * @author Richard Huamán <richard21hg92@gmail.com>
 * 
 */
class UpdateAction extends Action
{
    /**
     * @var string the scenario to be assigned to the model before it is validated and updated.
     */
    public $scenario = Model::SCENARIO_DEFAULT;


    /**
     * Updates an existing model.
     * @param string $id the primary key of the model.
     * @return \yii\db\ActiveRecordInterface the model being updated
     * @throws ServerErrorHttpException if there is any error when updating the model
     */
    public function run($id)
    {
        /* @var $model ActiveRecord */
        $model = $this->findModel($id);

        // print_r($model); die();
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $requestParams = Yii::$app->getRequest()->getBodyParams();
        $file = UploadedFile::getInstanceByName('logo');

        $usuarioId = Yii::$app->getRequest()->get('usuario_id', false);

        if (!$usuarioId) {
            throw new BadRequestHttpException("Bad Request");
        }
        //validar nombre duplicados por usuario
        ProyectoQuery::validateDuplicateUpdate($usuarioId, $requestParams['nombre'], $id);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $requestParams['actualizado_por'] = Params::getAudit();
            $requestParams['usuario_id'] = $usuarioId;

            $model->load($requestParams, '');
            if (!$model->save()) {
                throw new BadRequestHttpException('Error al actualizar el proyecto');
            }

            ProyectoInformacion::actualizar($requestParams, $model->id);

            if ($file) {
                // Eliminar asignación del proyecto_archivo anteriores
                $archivoId = ProyectoArchivo::eliminar($model->id);

                // Eliminar archivo asignado al proyecto
                Archivos::elimnar($archivoId);

                ProyectoUtil::loadFile($id, $file);
            }

            $transaction->commit();
        } catch (Exception $ex) {
            $transaction->rollBack();
            throw $ex;
        }

        return $model;
    }
}
