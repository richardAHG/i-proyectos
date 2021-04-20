<?php

namespace app\modules\v1\models\custom;

use app\modules\v1\models\ProyectoAreasModel;

class ProyectoAreasCustomModel extends ProyectoAreasModel
{
    public $name;
    public $description;
    public $typeId;
    public $proyectId;
    public $areaId;

    public function fields()
    {
        return ['name','description','typeId','proyectId','areaId'];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->name = $this->nombre;
        $this->description = $this->descripcion;
        $this->typeId = $this->tipo_id;
        $this->proyectId = $this->proyecto_id;
        $this->areaId = $this->id;
    }
}

