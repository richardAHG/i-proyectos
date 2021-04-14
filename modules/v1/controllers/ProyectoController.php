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

        return $actions;
    }
}
