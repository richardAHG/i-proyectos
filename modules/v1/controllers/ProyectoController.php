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

        // etapa
        $areaModel = 'app\modules\v1\models\ProyectoEtapasModel';
        $actions['etapaCreate'] = [
            'class' => 'app\modules\v1\controllers\etapa\CreateAction',
            'modelClass' => $areaModel
        ];

        $actions['etapaUpdate'] = [
            'class' => 'app\modules\v1\controllers\etapa\UpdateAction',
            'modelClass' => $areaModel
        ];

        $actions['etapaDelete'] = [
            'class' => 'app\modules\v1\controllers\etapa\DeleteAction',
            'modelClass' => $areaModel
        ];

        $actions['etapaIndex'] = [
            'class' => 'app\modules\v1\controllers\etapa\IndexAction',
            'modelClass' => $areaModel
        ];

        $actions['etapaView'] = [
            'class' => 'app\modules\v1\controllers\etapa\ViewAction',
            'modelClass' => $areaModel
        ];

        //Colaborador
        $colaboradorModel = 'app\modules\v1\models\ProyectoColaboradoresModel';
        $actions['colaboradorCreate'] = [
            'class' => 'app\modules\v1\controllers\colaborador\CreateAction',
            'modelClass' => $colaboradorModel
        ];

        $actions['colaboradorAceptado'] = [
            'class' => 'app\modules\v1\controllers\colaborador\IndexAction',
            'modelClass' => $colaboradorModel
        ];


        return $actions;
    }
}
