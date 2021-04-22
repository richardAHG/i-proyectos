<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\area\colaborador;

use app\modules\v1\constants\Params;
use app\modules\v1\utils\event\AreaEvent;
use app\modules\v1\utils\format\Format;
use app\modules\v1\utils\format\FormatFields;
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

        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }
        
        $model->estado = false;

        if (!$model->save()) {
            throw new BadRequestHttpException("Error al eliminar el usuario del area");
        }

        $estructura = FormatFields::AreaColaborador();
        $data = Format::init($model, $estructura, true);
        return $data;
    }
}
