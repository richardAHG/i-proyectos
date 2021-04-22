<?php

namespace app\modules\v1\utils\format;

class Format
{
    public static function init($estructuraformulario,$estructuraTable, $reverse = false)
    {
        
        if ($reverse) {
            $estructuraTable = self::reverse($estructuraTable);
        }
        return self::format($estructuraformulario, $estructuraTable);
    }

    public static function reverse($data)
    {
        $newData = [];
        foreach ($data as $key => $value) {
            $newData[$value] = $key;
        }
        return $newData;
    }
    
    public static function format($estructuraForm = [], $estructuraTable = [])
    {
        
        $result = [];
        foreach ($estructuraForm as $key => $value) {
            $info = array_search($key, $estructuraTable);          
            if ($info) {
                echo "Ingrese";
                $result[$info] = $value;                
            }
            print_r($info);
        }
        print_r($result); die();

        return $result;
    }

}
