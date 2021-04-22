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




}