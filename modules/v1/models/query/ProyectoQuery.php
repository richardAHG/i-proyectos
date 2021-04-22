<?php

namespace app\modules\v1\models\query;

use app\modules\v1\models\ProyectoAreasModel;
use app\modules\v1\models\ProyectoColaboradoresModel;
use app\modules\v1\models\ProyectosModel;
use yii\web\BadRequestHttpException;

class ProyectoQuery
{
    public static function validateDuplicate($usuarioId, $nombre)
    {
        $exist = ProyectosModel::find()
            ->where(['usuario_id' => $usuarioId])
            ->andWhere([
                'estado' => true,
                'upper(nombre)' => mb_strtoupper($nombre)
            ])
            ->one();
        if (isset($exist)) {
            throw new BadRequestHttpException("Name already exists, process canceled");
        }
    }

    public static function validateDuplicateUpdate($usuarioId, $nombre, $proyectoId)
    {
        $exist = ProyectosModel::find()
            ->where(['usuario_id' => $usuarioId])
            ->andWhere(['NOT', ['id' => $proyectoId]])
            ->andWhere([
                'estado' => true,
                'upper(nombre)' => mb_strtoupper($nombre)
            ])
            ->one();
        if (isset($exist)) {
            throw new BadRequestHttpException("Name already exists, process canceled");
        }
    }

    public static function validateInvitation($usuarioId, $proyectoId, $invitacionId)
    {
        $model = ProyectoColaboradoresModel::find()
            ->where([
                'estado' => true,
                'usuario_id' => $usuarioId,
                'proyecto_id' => $proyectoId,
                'invitacion_id' => $invitacionId
            ])
            ->one();
        return $model;
    }

    /**
     * Valida si area pertenece al proyecto
     *
     * @param int $prouyectoId
     * @param int $areaId
     * @return void
     */
    public static function ValidateProjectArea($proyectoId, $areaId)
    {
        $model = ProyectoAreasModel::findOne(['id' => $areaId, 'proyecto_id' => $proyectoId]);

        if (!$model) {
            throw new BadRequestHttpException("El area no pertence al proyecto");
        }
    }

    public static function validateProyectoColaborador($proyectoId, $colaboradorId)
    {
        $model = ProyectoColaboradoresModel::findOne([
            'id' => $colaboradorId,
            'proyecto_id' => $proyectoId,
            'estado' => true
        ]);

        if (!$model) {
            throw new BadRequestHttpException("El usuario no pertenece al proyecto");
        }
    }

    public static function valdiateAreaColaborador($proyectoId, $colaboradorId)
    {
        $query = (new \yii\db\Query())
            ->select(['pa.id'])
            ->from('proyectos.proyecto_areas pa')
            ->join(
                'INNER JOIN',
                'proyectos.area_colaboradores ac',
                'pa.id=ac.area_id and pa.estado is true'
            )
            ->where([
                'pa.proyecto_id' => $proyectoId,
                'colaborador_id' => $colaboradorId
            ])
            ->one();

        if ($query) {
            throw new BadRequestHttpException("el usuario ya pertenece a un area del mismo proyecto");
        }
    }
}
