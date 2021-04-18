<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "auth.usuarios".
 *
 * @property int $id
 * @property string $nombre_usuario
 * @property string $contrasenia
 * @property string $token_cuenta
 * @property bool $cambio_contrasenia
 * @property string $creado_por
 * @property string|null $actualizado_por
 * @property string|null $eliminado_por
 * @property bool $estado
 * @property bool|null $doble_factor
 */
class UsuariosModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth.usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_usuario', 'contrasenia', 'token_cuenta', 'creado_por'], 'required'],
            [['contrasenia', 'token_cuenta', 'creado_por', 'actualizado_por', 'eliminado_por'], 'string'],
            [['cambio_contrasenia', 'estado', 'doble_factor'], 'boolean'],
            [['nombre_usuario'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_usuario' => 'Nombre Usuario',
            'contrasenia' => 'Contrasenia',
            'token_cuenta' => 'Token Cuenta',
            'cambio_contrasenia' => 'Cambio Contrasenia',
            'creado_por' => 'Creado Por',
            'actualizado_por' => 'Actualizado Por',
            'eliminado_por' => 'Eliminado Por',
            'estado' => 'Estado',
            'doble_factor' => 'Doble Factor',
        ];
    }
}
