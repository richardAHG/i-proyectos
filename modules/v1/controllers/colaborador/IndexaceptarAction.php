<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\colaborador;

use app\helpers\Response;
use app\modules\v1\constants\Globals;
use app\modules\v1\constants\Params;
use app\modules\v1\models\query\UsuarioQuery;
use DateTime;
use DateTimeZone;
use enmodel\iwasi\library\rest\Action;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;

/**
 * IndexAction implements the API endpoint for listing multiple models.
 *
 * For more details and usage information on IndexAction, see the [guide article on rest controllers](guide:rest-controllers).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexaceptarAction extends Action
{

    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        return $this->prepareDataProvider();
    }

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider()
    {
        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }
        $proyectoId = Yii::$app->getRequest()->get($this->customToken, false);
        $token = Yii::$app->getRequest()->get('token', false);
        $usuarioId = Yii::$app->getRequest()->get('id', false);

        if (!$proyectoId || !$token || !$usuarioId) {
            throw new BadRequestHttpException("Bad Request");
        }

        //Verificar validez de usuario que invita
        UsuarioQuery::validateUsuario($requestParams['usuario_id']);

        //Verificar validez de usuario que es invitado
        UsuarioQuery::validateUsuario($requestParams['usuario_id']);

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $usuario = $modelClass::find()
            ->where([
                "estado" => true,
                "proyecto_id" => $proyectoId,
                "invitacion_id" => Globals::INVITACION_PENDIENTE,
                "id" => $usuarioId
            ])
            ->andWhere("token=:token", [":token" => $token])
            ->one();
        if (!$usuario) {
            throw new BadRequestHttpException("Token invalido");
        }

        //Verificar la vigencia de la fecha
        $today = new DateTime('now', new DateTimeZone('America/Lima'));
        $vigencia = new DateTime($usuario->fecha_expiracion, new DateTimeZone('America/Lima'));
        if ($today <= $vigencia) {
            $usuario->invitacion_id = Globals::INVITACION_APROBADO;
            $usuario->actualizado_por = Params::getAudit();
            if (!$usuario->save()) {
                throw new BadRequestHttpException("Error al procesar la información");
            }
            Response::JSON(200, "Proceso Finalizádo con éxito");
        } else {
            throw new BadRequestHttpException("La invitación ya expiró");
        }
    }
}
