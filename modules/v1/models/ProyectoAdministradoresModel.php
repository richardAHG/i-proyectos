<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.proyecto_administradores".
 *
 * @property int $id
 * @property int $colaborador_id
 * @property bool $estado
 */
class ProyectoAdministradoresModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.proyecto_administradores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['colaborador_id'], 'required'],
            [['colaborador_id'], 'default', 'value' => null],
            [['colaborador_id'], 'integer'],
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
            'colaborador_id' => 'Colaborador ID',
            'estado' => 'Estado',
        ];
    }
}
