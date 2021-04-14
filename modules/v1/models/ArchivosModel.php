<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "proyectos.archivos".
 *
 * @property int $id
 * @property string $ruta
 * @property string $tipo
 * @property int $peso
 * @property string $nombre
 * @property string $extension
 * @property bool $estado
 */
class ArchivosModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos.archivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ruta', 'tipo', 'peso', 'nombre', 'extension'], 'required'],
            [['ruta'], 'string'],
            [['peso'], 'default', 'value' => null],
            [['peso'], 'integer'],
            [['estado'], 'boolean'],
            [['tipo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 100],
            [['extension'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ruta' => 'Ruta',
            'tipo' => 'Tipo',
            'peso' => 'Peso',
            'nombre' => 'Nombre',
            'extension' => 'Extension',
            'estado' => 'Estado',
        ];
    }
}
