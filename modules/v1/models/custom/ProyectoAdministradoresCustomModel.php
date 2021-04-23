<?php

namespace app\modules\v1\models\custom;

use app\modules\v1\models\ProyectoAdministradoresModel;

class ProyectoAdministradoresCustomModel extends ProyectoAdministradoresModel
{
    public $collaboratorId;
    public $administratorId;
    

    public function fields()
    {
        return ['collaboratorId','administratorId'];
    }

    public function afterFind()
    {
        parent::afterFind();                
        $this->collaboratorId = $this->colaborador_id;
        $this->administratorId = $this->id;
    }
}

