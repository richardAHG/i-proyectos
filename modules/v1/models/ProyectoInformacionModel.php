<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.proyecto_informacion".
 *
 * @property int $id
 * @property int $color_id
 * @property int $proyecto_id
 * @property string $descripcion
 * @property bool $estado
 */
class ProyectoInformacionModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.proyecto_informacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color_id', 'proyecto_id', 'descripcion'], 'required'],
            [['color_id', 'proyecto_id'], 'default', 'value' => null],
            [['color_id', 'proyecto_id'], 'integer'],
            [['descripcion'], 'string'],
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
            'color_id' => 'Color ID',
            'proyecto_id' => 'Proyecto ID',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
        ];
    }
}
