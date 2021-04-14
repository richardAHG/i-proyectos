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
        
        return $actions;
    }
}
