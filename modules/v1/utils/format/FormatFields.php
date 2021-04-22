<?php

namespace app\modules\v1\utils\format;

class FormatFields
{
    public static function Etapa(){
        return[           
            'id' => 'stageId',
            'proyecto_id' => 'proyectId',
            'nombre' => 'name'
        ];
    }

    public static function Area(){
        return[    
            'id' => 'areaId',
            'proyecto_id' => 'proyectId',
            'nombre' => 'name',
            'descripcion' => 'description',
            'tipo_id' => 'typeId'
           
        ];
    }

    public static function Colaborador(){
        return[    
            'id' => 'collaboratorId',
            'invitacion_id' => 'invitationId',
            'usuario_id' => 'userId',
            'proyecto_id' => 'proyectId'           
           
        ];
    }


    public static function AreaColaborador(){
        return[    
            'id' => 'areaCollaboratorId',
            'colaborador_id' => 'collaboratorId',
            'area_id' => 'areaId',
            'fecha_registro' => 'dateRegistration'           
           
        ];
    }

}