<?php

namespace app\modules\v1\controllers;

use app\rest\ActiveController;

class ProyectoController extends ActiveController
{
    public $modelClass = 'app\modules\v1\models\custom\ProyectosCustomModel';

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
        $areaModel = 'app\modules\v1\models\custom\ProyectoAreasCustomModel';
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

        // Area Colaborador
        $areaColaboradorModel = 'app\modules\v1\custom\AreaColaboradoresCustomModel';

        $actions['areaColaboradorCreate'] = [
            'class' => 'app\modules\v1\controllers\area\colaborador\CreateAction',
            'modelClass' => $areaColaboradorModel
        ];

        $actions['areaColaboradorDelete'] = [
            'class' => 'app\modules\v1\controllers\area\colaborador\DeleteAction',
            'modelClass' => $areaColaboradorModel
        ];

        $actions['areaColaboradorIndex'] = [
            'class' => 'app\modules\v1\controllers\area\colaborador\IndexAction',
            'modelClass' => $areaColaboradorModel
        ];

        $actions['areaColaboradorView'] = [
            'class' => 'app\modules\v1\controllers\area\colaborador\ViewAction',
            'modelClass' => $areaColaboradorModel
        ];


        // etapa
        $areaModel = 'app\modules\v1\models\custom\ProyectoEtapasCustomModel';
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
        $colaboradorModel = 'app\modules\v1\models\custom\ProyectoColaboradoresCustomModel';
        $actions['colaboradorCreate'] = [
            'class' => 'app\modules\v1\controllers\colaborador\CreateAction',
            'modelClass' => $colaboradorModel
        ];

        $actions['colaboradorAceptado'] = [
            'class' => 'app\modules\v1\controllers\colaborador\IndexaceptarAction',
            'modelClass' => $colaboradorModel
        ];
        $actions['colaboradorIndex'] = [
            'class' => 'app\modules\v1\controllers\colaborador\indexAction',
            'modelClass' => $colaboradorModel
        ];
        $actions['colaboradorView'] = [
            'class' => 'app\modules\v1\controllers\colaborador\ViewAction',
            'modelClass' => $colaboradorModel
        ];
        $actions['colaboradorDelete'] = [
            'class' => 'app\modules\v1\controllers\colaborador\DeleteAction',
            'modelClass' => $colaboradorModel
        ];

        return $actions;
    }
}
