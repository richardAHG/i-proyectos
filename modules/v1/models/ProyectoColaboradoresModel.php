<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.proyecto_colaboradores".
 *
 * @property int $id
 * @property int $proyecto_id
 * @property int $usuario_id
 * @property int $invitacion_id
 * @property string $creado_por
 * @property string|null $actualizado_por
 * @property string|null $eliminado_por
 * @property bool $estado
 */
class ProyectoColaboradoresModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.proyecto_colaboradores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proyecto_id', 'usuario_id', 'invitacion_id', 'creado_por'], 'required'],
            [['proyecto_id', 'usuario_id', 'invitacion_id'], 'default', 'value' => null],
            [['proyecto_id', 'usuario_id', 'invitacion_id'], 'integer'],
            [['creado_por', 'actualizado_por', 'eliminado_por'], 'string'],
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
            'usuario_id' => 'Usuario ID',
            'invitacion_id' => 'Invitacion ID',
            'creado_por' => 'Creado Por',
            'actualizado_por' => 'Actualizado Por',
            'eliminado_por' => 'Eliminado Por',
            'estado' => 'Estado',
        ];
    }
}
