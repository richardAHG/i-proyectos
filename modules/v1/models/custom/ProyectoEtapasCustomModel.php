<?php

namespace app\modules\v1\models\custom;

use app\modules\v1\models\ProyectoEtapasModel;

class ProyectoEtapasCustomModel extends ProyectoEtapasModel
{
    public $name;
    public $proyectId;
    public $stageId;

    public function fields()
    {
        return ['name','proyectId','stageId'];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->name = $this->nombre;
        $this->proyectId = $this->proyecto_id;
        $this->stageId = $this->id;
    }
}

