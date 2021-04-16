<?php

namespace app\modules\v1\controllers;

use enmodel\iwasi\library\rest\ActiveController;

// use app\rest\ActiveController;

class EtapaController extends ActiveController
{
    public $modelClass = 'app\modules\v1\models\ProyectoEtapasModel';

    public function actions()
    {
        $actions = parent::actions();

        $actions['create']['class'] = 'app\modules\v1\controllers\etapa\CreateAction';
        $actions['update']['class'] = 'app\modules\v1\controllers\etapa\UpdateAction';
        // $actions['d']['class'] = 'app\modules\v1\controllers\etapa\CreateAction';
        // $actions['create']['class'] = 'app\modules\v1\controllers\etapa\CreateAction';

        // $actions['delete']['class'] = 'app\modules\v1\controllers\proyecto\DeleteAction';

        
        
        return $actions;
    }
}
