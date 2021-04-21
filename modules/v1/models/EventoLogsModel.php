<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.evento_logs".
 *
 * @property int $id
 * @property int $log_tabla_id
 * @property int $log_evento_id
 * @property int $registro_id
 * @property string $mensaje
 * @property string $fecha_hora
 * @property int $usuario_id
 */
class EventoLogsModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.evento_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['log_tabla_id', 'log_evento_id', 'registro_id', 'mensaje', 'fecha_hora', 'usuario_id'], 'required'],
            [['log_tabla_id', 'log_evento_id', 'registro_id', 'usuario_id'], 'default', 'value' => null],
            [['log_tabla_id', 'log_evento_id', 'registro_id', 'usuario_id'], 'integer'],
            [['fecha_hora'], 'safe'],
            [['mensaje'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'log_tabla_id' => 'Log Tabla ID',
            'log_evento_id' => 'Log Evento ID',
            'registro_id' => 'Registro ID',
            'mensaje' => 'Mensaje',
            'fecha_hora' => 'Fecha Hora',
            'usuario_id' => 'Usuario ID',
        ];
    }
}
