<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\area;

use app\modules\v1\constants\Params;
use app\modules\v1\models\query\AreaQuery;
use app\modules\v1\utils\event\AreaEvent;
use enmodel\iwasi\library\rest\Action;
use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Crea una etapa.
 *
 * Crea una etapa, registra su etapa.
 *
 * @author Richard Huamán <richard21hg92@gmail.com>
 * 
 */
class CreateAction extends Action
{
    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = Model::SCENARIO_DEFAULT;
    /**
     * @var string the name of the view action. This property is needed to create the URL when the model is successfully created.
     */
    public $viewAction = 'view';


    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     * @throws ServerErrorHttpException if there is any error when creating the model
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        /* @var $model \yii\db\ActiveRecord */
        $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]);

        $requestParams = Yii::$app->getRequest()->getBodyParams();
        $proyectoId = Yii::$app->getRequest()->get($this->customToken, false);

        if (!$proyectoId) {
            throw new BadRequestHttpException("Bad Request");
        }

        //validación de nombres duplicados
        AreaQuery::validateDuplicate($requestParams['nombre'],$proyectoId);

        $requestParams['proyecto_id'] = $proyectoId;
        $requestParams['creado_por'] = Params::getAudit();
        $model->load($requestParams, '');
        if (!$model->save()) {
            throw new BadRequestHttpException('Error al registrar el area');
        }
        (new AreaEvent($model))->creacion();
        return $model;
    }
}
