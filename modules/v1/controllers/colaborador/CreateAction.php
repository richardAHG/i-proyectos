<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\colaborador;

use app\helpers\Mailer;
use app\helpers\Response;
use app\helpers\Utils;
use app\modules\v1\constants\Globals;
use app\modules\v1\constants\Params;
use app\modules\v1\models\ParametrosModel;
use app\modules\v1\models\ProyectoColaboradoresModel;
use app\modules\v1\models\query\ProyectoQuery;
use app\modules\v1\models\query\UsuarioQuery;
use app\modules\v1\models\UsuariosModel;
use app\modules\v1\utils\event\ColaboradorEvent;
use DateInterval;
use DateTime;
use enmodel\iwasi\library\rest\Action;
use Exception;
use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Crea una etapa.
 *
 * Crea una etapa, registra su etapa.
 *
 * @author Richard Huamán <richard21hg92@gmail.com>
 * 
 */
class CreateAction extends Action
{
    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = Model::SCENARIO_DEFAULT;
    /**
     * @var string the name of the view action. This property is needed to create the URL when the model is successfully created.
     */
    public $viewAction = 'view';


    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     * @throws ServerErrorHttpException if there is any error when creating the model
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        /* @var $model \yii\db\ActiveRecord */
        $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]);

        $requestParams = Yii::$app->getRequest()->getBodyParams();
        $proyectoId = Yii::$app->getRequest()->get($this->customToken, false);
        $usuario_id = Yii::$app->getRequest()->get('usuario_id', false);

        if (!$proyectoId) {
            throw new BadRequestHttpException("Bad Request");
        }

        //obtenar datos del usuario emisor
        $usuario_emisor = UsuarioQuery::validateUsuario($usuario_id);

        //obtenar datos de usuario receptor
        $usuario_receptor = UsuarioQuery::validateUsuario($requestParams['usuario_id']);

        //Validar si el proyecto pertenece al usuario
        UsuarioQuery::ValidateUserProject($usuario_id, $proyectoId);

        try {
            //buscar si el usuario ya fue invitado
            $proyectoColaborador = ProyectoQuery::validateInvitation($requestParams['usuario_id'], $proyectoId, Globals::INVITACION_PENDIENTE);
            // print_r($proyectoColaborador); die();
            if ($proyectoColaborador) {
                Response::JSON(300,"El usuario ya fue invitado a participar en este proyecto");
            } else {
                //obtener estado de invitacion del usuario, invitacion != aceptado se enviara correo

                $proyectoColaborador = ProyectoQuery::validateInvitation($requestParams['usuario_id'], $proyectoId, Globals::INVITACION_APROBADO);
                if ($proyectoColaborador) {
                    throw new BadRequestHttpException("El usuario ya acepto la invitacion a este proyecto");
                }

                //traer dias habiles
                $dias = ParametrosModel::findOne(['grupo' => Globals::GRUPO_DIAS_VALIDOS, 'estado' => true]);

                //agregar dias validos
                $fecha = new DateTime('now');
                $fecha->add(new DateInterval("P{$dias->valor}D"));
                $fecha_expiracion = $fecha->format('Y-m-d');

                $token = Utils::token("sha1", uniqid(), 6);
                $requestParams['proyecto_id'] = $proyectoId;
                $requestParams['invitacion_id'] = Globals::INVITACION_PENDIENTE;
                $requestParams['creado_por'] = Params::getAudit();
                $requestParams['token'] = $token;
                $requestParams['fecha_expiracion'] = $fecha_expiracion;

                $model->load($requestParams, '');

                if (!$model->save()) {
                    throw new BadRequestHttpException('Error al registrar al colaborador');
                }

                self::envioCorreo($usuario_receptor, 'Invitación a participar en el proyecto', $usuario_emisor, $token, $proyectoId, $model->id);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        (new ColaboradorEvent($model))->creacion();
        return $model;
    }

    public static function envioCorreo($usuario_receptor, $subject, $usuario_emisor, $token, $proyectoId, $id)
    {
        $mail = new Mailer();
        $propietarioId = $usuario_emisor->id;
        $ruta = "http://localhost/iwasi/iwasi-proyectos/v1/{$propietarioId}/proyecto/{$proyectoId}/colaborador/aceptar?token={$token}&id={$id}";
        $params = [
            "ruta" => $ruta,
            'email_r' => $usuario_receptor->nombre_usuario,
            'email_e' => $usuario_emisor->nombre_usuario,
            'organizacion' => 'iWasi',
        ];

        $body = Yii::$app->view->renderFile("{$mail->path}/invitar-particpacion-proyecto.php", compact("params"));
        $mail->send($usuario_receptor->nombre_usuario, $subject, $body);
    }
}
