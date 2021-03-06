<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\etapa;

use app\modules\v1\constants\Params;
use app\modules\v1\models\query\EtapaQuery;
use app\modules\v1\utils\event\EtapaEvent;
use app\modules\v1\utils\format\Format;
use app\modules\v1\utils\format\FormatFields;
use enmodel\iwasi\library\rest\Action;
use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

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

        $params = Yii::$app->getRequest()->getBodyParams(); 
        $estructura = FormatFields::Etapa();
        $requestParams = Format::init($params, $estructura);

        $proyectoId = Yii::$app->getRequest()->get('proyecto_id', false);

        if (!$proyectoId) {
            throw new BadRequestHttpException("Bad Request");
        }

        //validación de nombres duplicados
        EtapaQuery::validateDuplicate($requestParams['nombre'], $proyectoId, $id);

        $requestParams['actualizado_por'] = Params::getAudit();

        $model->load($requestParams, '');
        if (!$model->save()) {
            throw new BadRequestHttpException('Error al actualizar el proyecto');
        }

        $data = Format::init($model, $estructura, true);
        return $data;
    }
}
