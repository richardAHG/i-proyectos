<?php

namespace app\modules\v1\controllers;

use app\rest\ActiveController;

class ProyectoController extends ActiveController
{
    public $modelClass = 'app\modules\v1\models\ProyectosModel';

    public function actions()
    {
        $actions = parent::actions();

        $actions['create']['class'] = 'app\modules\v1\controllers\proyecto\CreateAction';
        $actions['delete']['class'] = 'app\modules\v1\controllers\proyecto\DeleteAction';

        $actions['updateproyecto'] = [
            'class' => 'app\modules\v1\controllers\proyecto\UpdateAction',
            'modelClass' => $this->modelClass
        ];

        $actions['etapaCreate'] = [
            'class' => 'app\modules\v1\controllers\etapa\CreateAction',
            'modelClass' => 'app\modules\v1\models\ProyectoEtapasModel'
        ];

        // Area
        $areaModel = 'app\modules\v1\models\ProyectoAreasModel';
        $actions['areaCreate'] = [
            'class' => 'app\modules\v1\controllers\area\CreateAction',
            'modelClass' => $areaModel
        ];

        $actions['areaUpdate'] = [
            'class' => 'app\modules\v1\controllers\area\UpdateAction',
            'modelClass' => $areaModel
        ];

        $actions['areaDelete'] = [
            'class' => 'app\modules\v1\controllers\area\DeleteAction',
            'modelClass' => $areaModel
        ];

        $actions['areaIndex'] = [
            'class' => 'app\modules\v1\controllers\area\IndexAction',
            'modelClass' => $areaModel
        ];

        $actions['areaView'] = [
            'class' => 'app\modules\v1\controllers\area\ViewAction',
            'modelClass' => $areaModel
        ];

        return $actions;
    }
}
