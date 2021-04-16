<?php

namespace app\modules\v1\controllers\proyecto;

use app\modules\v1\constants\Params;
use app\modules\v1\models\clases\ProyectoInformacion;
use app\modules\v1\models\query\ProyectoQuery;
use app\modules\v1\utils\ProyectoUtil;
use app\rest\Action;
use Exception;
use Yii;
use yii\base\Model;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

/**
 * @author Richard Huaman <richard21hg92@gmail.com>
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
        $file = UploadedFile::getInstanceByName('logo');
        $usuario_id = Yii::$app->getRequest()->get('usuario_id', false);

        //validar nombre duplicados por usuario
        ProyectoQuery::validateDuplicate($usuario_id, $requestParams['nombre']);
        
        $transaction = Yii::$app->db->beginTransaction();
        try {

            $requestParams['usuario_id'] = $usuario_id;
            $requestParams['creado_por'] = Params::getAudit();
            $model->load($requestParams, '');
            if (!$model->save()) {
                throw new ServerErrorHttpException('Error al guardar el proyecto');
            }

            ProyectoInformacion::insertar($requestParams, $model->id);
            // print_r($model); die();
            ProyectoUtil::loadFile($model->id, $file);

            $transaction->commit();
        } catch (Exception $ex) {
            $transaction->rollBack();
            echo $ex->getMessage();
        }

        return $model;
    }
}
