<?php

namespace app\modules\v1\controllers\area\colaborador;

use app\modules\v1\models\query\ProyectoQuery;
use app\modules\v1\models\query\UsuarioQuery;
use Yii;
use yii\rest\Action as RestAction;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * La acción es la clase base para las clases de acción 
 * que implementan la API RESTful.
 * 
 * @author Richard Huaman <richard21hg92@gmail.com>
 */
class Action extends RestAction
{
    public $usuarioId = "usuario_id";
    public $proyectoId = "proyecto_id";
    public $areaId = "area_id";

    public function init()
    {
        parent::init();
        $usuarioId = Yii::$app->getRequest()->get($this->usuarioId, false);
        $proyectoId = Yii::$app->getRequest()->get($this->proyectoId, false);
        $areaId = Yii::$app->getRequest()->get($this->areaId, false);

        //validar si el proyecto pertenece al usuario
        UsuarioQuery::ValidateUserProject($usuarioId, $proyectoId);

        //validar si el area pertenece al proyecto
        ProyectoQuery::ValidateProjectArea($proyectoId, $areaId);
        
        if (!$usuarioId || !$proyectoId || !$areaId) {
            throw new BadRequestHttpException("Bad Request");
        }
        
        $this->findModel = function ($id, $action) {

            $areaId = Yii::$app->getRequest()->get($this->areaId, false);
            if (!$areaId) {
                throw new BadRequestHttpException("Bad Request");
            }

            $modelClass = $action->modelClass;
            // $model = $modelClass::findIfBelongsToProject($id, $proyectoId);
            $model = $modelClass::find()
                ->where(["id" => $id])
                ->andWhere([
                    "estado" => true,
                    'area_id' => $areaId
                ])
                ->one();
            if (isset($model)) {
                return $model;
            }

            throw new NotFoundHttpException("Object not found: $id");
        };
    }
}
