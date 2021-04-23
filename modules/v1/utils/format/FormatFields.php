<?php

namespace app\modules\v1\utils\format;

class FormatFields
{
    public static function Proyecto(){
        return[    
            'id' => 'proyectId',            
            'nombre' => 'name',
            'usuario_id' => 'userId',
            'color'=>'colour',
            'logo' => 'logo',
            'descripcion' => 'description'
        ];
    }
    public static function Etapa(){
        return[           
            'id' => 'stageId',
            'nombre' => 'name',
            'proyecto_id' => 'proyectId'
            
        ];
    }
    public static function Area(){
        return[    
            'id' => 'areaId',
            'nombre' => 'name',                    
            'descripcion' => 'description',
            'tipo_id' => 'typeId',
            'proyecto_id' => 'proyectId'
           
        ];
    }
    public static function Colaborador(){
        return[    
            'id' => 'collaboratorId',
            'proyecto_id' => 'proyectId',            
            'usuario_id' => 'userId',
            'invitacion_id' => 'invitationId' 
        ];
    }
    public static function AreaColaborador(){
        return[    
            'id' => 'areaCollaboratorId',
            'colaborador_id' => 'collaboratorId',
            'area_id' => 'areaId',
            'fecha_registro' => 'startDate'
        ];
    }
    public static function Administrador(){
        return[
            'id' => 'administratorId',
            'colaborador_id' => 'collaboratorId'            
        ];
    }
}