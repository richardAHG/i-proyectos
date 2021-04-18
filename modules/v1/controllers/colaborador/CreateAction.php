<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v1\controllers\colaborador;

use app\helpers\Mailer;
use app\modules\v1\constants\Globals;
use app\modules\v1\constants\Params;
use app\modules\v1\models\ProyectoColaboradoresModel;
use app\modules\v1\models\query\AreaQuery;
use app\modules\v1\models\query\EtapaQuery;
use app\modules\v1\models\UsuarioRecuperacionModel;
use app\modules\v1\models\UsuariosModel;
use enmodel\iwasi\library\rest\Action;
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
        $usuario_emisor = UsuariosModel::find()
            ->where(['estado' => true, 'id' => $usuario_id])->one();

        if (!$usuario_emisor) {
            throw new BadRequestHttpException("No existe el usuario");
        }

        //obtenar datos de usuario receptor
        $usuario_receptor = UsuariosModel::find()
            ->where(['estado' => true, 'id' => $requestParams['usuario_id']])->one();

        if (!$usuario_receptor) {
            throw new BadRequestHttpException("No existe el usuario");
        }

        //obtener estado de invitacion del usuario, invitacion <> aceptado se enviara correo
        $proyectoColaborador = ProyectoColaboradoresModel::find()
            ->where([
                'estado' => true,
                'usuario_id' => $requestParams['usuario_id'],
                'proyecto_id' => $proyectoId,
                'invitacion_id' => Globals::INVITACION_APROBADO
            ])
            ->one();
        if ($proyectoColaborador) {
            throw new BadRequestHttpException("El usuario ya acepto la invitacion a este proyecto");
        }

        $requestParams['proyecto_id'] = $proyectoId;
        $requestParams['invitacion_id'] = Globals::INVITACION_PENDIENTE;
        $requestParams['creado_por'] = Params::getAudit();
        $model->load($requestParams, '');

        if (!$model->save()) {
            throw new BadRequestHttpException('Error al registrar al colaborador');
        }

        self::envioCorreo($usuario_receptor, 'Invitación a participar en el proyecto', $usuario_emisor);

        return $model;
    }

    public static function envioCorreo($usuario_receptor, $subject, $usuario_emisor)
    {
        $mail = new Mailer();
        $params = [
            "ruta" => 'www.iwasi/invitar-particpacion-proyecto',
            // 'nombre_r' => $usuario_receptor->nombre,
            'email_r' => $usuario_receptor->nombre_usuario,
            // 'nombre_e' => $usuario_emisor->nombre,
            'email_e' => $usuario_emisor->nombre_usuario,
            'organizacion' => 'iWasi'
        ];

        $body = Yii::$app->view->renderFile("{$mail->path}/invitar-particpacion-proyecto.php", compact("params"));
        $mail->send($usuario_receptor->nombre_usuario, $subject, $body);
    }
}
