<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.parametros".
 *
 * @property int $id
 * @property string|null $grupo
 * @property string|null $nombre
 * @property string|null $valor
 * @property bool|null $estado
 */
class ParametrosModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.parametros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor'], 'string'],
            [['estado'], 'boolean'],
            [['grupo', 'nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grupo' => 'Grupo',
            'nombre' => 'Nombre',
            'valor' => 'Valor',
            'estado' => 'Estado',
        ];
    }
}
