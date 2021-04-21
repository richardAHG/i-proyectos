<?php

namespace app\modules\v1\utils\event;

use app\helpers\Date;
use app\modules\v1\constants\Params;
use app\modules\v1\models\EventoLogsModel;
use yii\web\BadRequestHttpException;

class Event
{
    protected $_id;

    public function __construct($id)
    {
        $this->_id = $id;
    }

    public function register($tabla_id, $evento_id, $mensaje)
    {
        $eventoModel = new EventoLogsModel();
        $eventoModel->log_tabla_id = $tabla_id;
        $eventoModel->log_evento_id = $evento_id;
        $eventoModel->registro_id = $this->_id;
        $eventoModel->mensaje = $mensaje;
        $eventoModel->usuario_id = Params::getUserId();
        $eventoModel->fecha_hora = Date::getDateTime();

        if (!$eventoModel->save()) {
            throw new BadRequestHttpException("Error al registrar el log de eventos");
        }
    }
}
