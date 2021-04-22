<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\area\colaborador;

use app\modules\v1\constants\Params;
use app\modules\v1\controllers\area\colaborador\Action;
use app\modules\v1\models\query\ProyectoQuery;
use app\modules\v1\utils\event\AreaEvent;
use app\modules\v1\utils\format\Format;
use app\modules\v1\utils\format\FormatFields;
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

        $params = Yii::$app->getRequest()->getBodyParams(); 
        $estructura = FormatFields::Etapa();
        $requestParams = Format::init($params, $estructura);

        $proyectoId = Yii::$app->getRequest()->get($this->proyectoId, false);
        $areaId = Yii::$app->getRequest()->get($this->areaId, false);

        // Validar que el usuario pertenesca al proyecto, ya que el area pertenece a un determinado proyecto
        ProyectoQuery::validateProyectoColaborador($proyectoId, $requestParams['usuario_id']);

        //Validar que el usuario no se registre en varias areas de un mismo proyecto
        ProyectoQuery::valdiateAreaColaborador($proyectoId, $requestParams['usuario_id']);

        $requestParams['area_id'] = $areaId;
        $requestParams['colaborador_id'] = $requestParams['usuario_id'];
        $requestParams['fecha_registro'] = Params::getDate();
        $model->load($requestParams, '');
        // print_r($model); die();
        if (!$model->save()) {
            throw new BadRequestHttpException('Error al asignar el colaborador al area');
        }
        // (new AreaEvent($model))->creacion();
        $data = Format::init($model, $estructura, true);
        return $data;
    }
}
