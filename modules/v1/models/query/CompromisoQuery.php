<?php

namespace app\modules\v1\models\query;

use app\helpers\Response;
use Yii;
use yii\web\BadRequestHttpException;
use app\modules\v1\models\CompromisosModel;

class CompromisoQuery
{
    public static function validaSiExisteId($table, $column, $valor)
    {
        $query = "SELECT compromisos.fn_select_busqueda_por_id('{$table}','{$column}',$valor)";

        $rpta = Yii::$app->db->createCommand($query)->queryScalar();

        if ($rpta) {
            throw new BadRequestHttpException("No se puede eliminar,existen registros que dependen de este valor");
        }
    }
}
