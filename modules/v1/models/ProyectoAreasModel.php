<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.proyecto_areas".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $tipo_id
 * @property int $proyecto_id
 * @property string $creado_por
 * @property string|null $actualizado_por
 * @property string|null $eliminado_por
 * @property bool $estado
 */
class ProyectoAreasModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.proyecto_areas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'tipo_id', 'proyecto_id', 'creado_por'], 'required'],
            [['descripcion', 'creado_por', 'actualizado_por', 'eliminado_por'], 'string'],
            [['tipo_id', 'proyecto_id'], 'default', 'value' => null],
            [['tipo_id', 'proyecto_id'], 'integer'],
            [['estado'], 'boolean'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'tipo_id' => 'Tipo ID',
            'proyecto_id' => 'Proyecto ID',
            'creado_por' => 'Creado Por',
            'actualizado_por' => 'Actualizado Por',
            'eliminado_por' => 'Eliminado Por',
            'estado' => 'Estado',
        ];
    }
}
