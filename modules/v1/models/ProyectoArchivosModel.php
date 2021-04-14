<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.proyecto_archivos".
 *
 * @property int $id
 * @property int $proyecto_id
 * @property int $archivo_id
 * @property bool $estado
 */
class ProyectoArchivosModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.proyecto_archivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proyecto_id', 'archivo_id'], 'required'],
            [['proyecto_id', 'archivo_id'], 'default', 'value' => null],
            [['proyecto_id', 'archivo_id'], 'integer'],
            [['estado'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proyecto_id' => 'Proyecto ID',
            'archivo_id' => 'Archivo ID',
            'estado' => 'Estado',
        ];
    }
}
