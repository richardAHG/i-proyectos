<?php

namespace app\modules\v1\models\custom;

use app\modules\v1\models\ProyectosModel;

class ProyectoscustomModel extends ProyectosModel
{
    public $name;
    public $userId;
    public $proyectId;

    public function fields()
    {
        return ['name','userId','proyectId'];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->name = $this->nombre;
        $this->userId = $this->usuario_id;
        $this->proyectId = $this->id;
    }
}
