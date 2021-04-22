<?php

namespace app\modules\v1\controllers;

use enmodel\iwasi\library\rest\ActiveController;

class ParametroController extends ActiveController
{
    public $modelClass = 'app\modules\v1\models\ParametrosModel';

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['class'] = 'app\modules\v1\controllers\parametro\IndexAction';

        return $actions;
    }
}
