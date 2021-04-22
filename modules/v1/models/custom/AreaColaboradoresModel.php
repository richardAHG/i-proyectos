<?php

namespace app\modules\v1\models\custom;

use app\modules\v1\models\AreaColaboradoresModel;

class AreaColaboradoresCustomModel extends AreaColaboradoresModel
{
    public $name;
    public $userId;
    public $proyectId;

    public function fields()
    {
        return ['collaboratorId','areaId','dateRegistration','areaCollaboratorId'];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->collaboratorId = $this->colaborador_id;
        $this->areaId = $this->area_id;
        $this->dateRegistration = $this->fecha_registro;
        $this->areaCollaboratorId = $this->id;
    }
}
