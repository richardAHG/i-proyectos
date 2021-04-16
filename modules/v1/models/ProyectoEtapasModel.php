<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.proyecto_etapas".
 *
 * @property int $id
 * @property string $nombre
 * @property int $proyecto_id
 * @property string $creado_por
 * @property string|null $actualizado_por
 * @property string|null $eliminado_por
 * @property bool $estado
 */
class ProyectoEtapasModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.proyecto_etapas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'proyecto_id', 'creado_por'], 'required'],
            [['proyecto_id'], 'default', 'value' => null],
            [['proyecto_id'], 'integer'],
            [['creado_por', 'actualizado_por', 'eliminado_por'], 'string'],
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
            'proyecto_id' => 'Proyecto ID',
            'creado_por' => 'Creado Por',
            'actualizado_por' => 'Actualizado Por',
            'eliminado_por' => 'Eliminado Por',
            'estado' => 'Estado',
        ];
    }
}
