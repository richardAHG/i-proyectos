<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\area\colaborador;

use app\modules\v1\constants\Params;
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

        $model->estado = false;

        if (!$model->save()) {
            throw new BadRequestHttpException("Error al eliminar el usuario del area");
        }

        return $model;
    }
}
