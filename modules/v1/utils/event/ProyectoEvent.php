<?php

namespace app\modules\v1\utils\event;

use Yii;

class ProyectoEvent extends Event
{
    public $model;
    public function __construct($tableModel)
    {
        $this->model = $tableModel;
    }

    public function creacion()
    {
        Yii::info([
            'id' => $this->model->id,
            'tabla' => $this->model::tableName(),
            'mensaje' => "Se registró el id # {$this->model->id}"
        ], 'datos');
    }

    public function eliminacion()
    {
        Yii::info([
            'id' => $this->model->id,
            'tabla' => $this->model::tableName(),
            'mensaje' => "Se eliminó el id # {$this->model->id}"
        ], 'datos');
    }

    public function actualizacion()
    {
        Yii::info([
            'id' => $this->model->id,
            'tabla' => $this->model::tableName(),
            'mensaje' => "Se actualizó el id # {$this->model->id}"
        ], 'datos');
    }
}
