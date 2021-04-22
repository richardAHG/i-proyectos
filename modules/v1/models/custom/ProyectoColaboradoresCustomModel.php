<?php

namespace app\modules\v1\models\custom;

use app\modules\v1\models\ProyectoColaboradoresModel;

class ProyectoColaboradoresCustomModel extends ProyectoColaboradoresModel
{
    public $proyectId;
    public $userId;
    public $invitationId;
    public $collaboratorId;

    public function fields()
    {
        return ['proyectId','userId','invitationId','collaboratorId'];
    }

    public function afterFind()
    {
        parent::afterFind();        
        $this->proyectId = $this->proyecto_id;
        $this->userId = $this->usuario_id;
        $this->invitationId = $this->invitacion_id;
        $this->collaboratorId = $this->id;
    }
}

