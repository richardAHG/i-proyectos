<?php

namespace app\rest;

use app\modules\v1\constants\Params;
use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

/**
 * @author Richard Huaman <richard21hg92@gmail.com>
 */
class DeleteAction extends Action
{
    /**
     * @var string el escenario que se asignará al modelo antes de que sea validado y actualizado.
     */
    public $scenario = Model::SCENARIO_DEFAULT;

    /**
     * Eliminar un registro
     * 
     * @param mixed $id id of the model to be deleted.
     * @throws ServerErrorHttpException on failure.
     */
    public function run($id)
    {
        $model = $this->findModel($id);

        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        $model->estado = false;
        $model->eliminado_por = Params::getAudit();

        if (!$model->save()) {
            throw new BadRequestHttpException("Error al eliminar el proyecto");
        }

        return $model;
    }
}
