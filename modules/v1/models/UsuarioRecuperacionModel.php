<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "auth.usuario_recuperacion".
 *
 * @property int $id
 * @property int $usuario_id
 * @property bool $estado
 * @property string|null $celular
 * @property string|null $email
 * @property string $creado_por
 * @property string|null $actualizado_por
 */
class UsuarioRecuperacionModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth.usuario_recuperacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'creado_por'], 'required'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['estado'], 'boolean'],
            [['creado_por', 'actualizado_por'], 'string'],
            [['celular'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'estado' => 'Estado',
            'celular' => 'Celular',
            'email' => 'Email',
            'creado_por' => 'Creado Por',
            'actualizado_por' => 'Actualizado Por',
        ];
    }
}
