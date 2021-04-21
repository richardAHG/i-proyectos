<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.area_colaboradores".
 *
 * @property int $id
 * @property int $colaborador_id
 * @property int $area_id
 * @property string $fecha_registro
 * @property bool $estado
 */
class AreaColaboradoresModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.area_colaboradores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['colaborador_id', 'area_id', 'fecha_registro'], 'required'],
            [['colaborador_id', 'area_id'], 'default', 'value' => null],
            [['colaborador_id', 'area_id'], 'integer'],
            [['fecha_registro'], 'safe'],
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
            'area_id' => 'Area ID',
            'fecha_registro' => 'Fecha Registro',
            'estado' => 'Estado',
        ];
    }
}
