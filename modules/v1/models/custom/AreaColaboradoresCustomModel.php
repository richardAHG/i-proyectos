<?php

namespace app\modules\v1\models\custom;
use app\modules\v1\models\AreaColaboradoresModel;

class AreaColaboradoresCustomModel extends AreaColaboradoresModel
{
    public $collaboratorId;
    public $areaId;
    public $startDate;
    public $areaCollaboratorId;

    public function fields()
    {
        return ['collaboratorId','areaId','startDate','areaCollaboratorId'];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->collaboratorId = $this->colaborador_id;
        $this->areaId = $this->area_id;
        $this->startDate = $this->fecha_registro;
        $this->areaCollaboratorId = $this->id;
    }
}
