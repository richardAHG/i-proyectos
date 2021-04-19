<?php

namespace app\helpers;

use app\modules\v1\models\ParametrosModel;
use app\modules\v1\utils\event\Event;
use Yii;
use yii\log\DbTarget;

class EventDbTarget extends DbTarget
{
    public function export()
    {
        $evento = $this->getEvento();

        foreach ($this->messages as $message) {
            
            list($data, $level, $category, $timestamp) = $message;

            if (!is_string($data)) {
                // exceptions may not be serializable if in the call stack somewhere is a Closure
                if ($data instanceof \Throwable || $data instanceof \Exception) {
                    $data = (string) $data;
                }
                // else {
                //    $data = VarDumper::export($data);
                // }
            }

            $id = $data['id'];

            $evento = ParametrosModel::findOne([
                'grupo' => 'EVENTO',
                'nombre' => $evento,
                'estado' => true
            ]);

            $tabla = ParametrosModel::findOne([
                'grupo' => 'TABLA',
                'nombre' => str_replace('compromisos.','', $data['tabla']),
                'estado' => true
            ]);

            (new Event($id))->register(
                $tabla['valor'],
                $evento['valor'],
                $data['mensaje']
            );
        }
    }

    private function getEvento()
    {
        $method = Yii::$app->request->getMethod();

        $evento = [
            'POST' => 'create',
            'PUT' => 'update',
            'DELETE' => 'delete'
        ];

        return $evento[$method];
    }
}
?>