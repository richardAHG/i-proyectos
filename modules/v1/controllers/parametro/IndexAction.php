<?php

namespace app\modules\v1\controllers\parametro;

use app\modules\v1\constants\Params;
use enmodel\iwasi\library\rest\Action;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;

/**
 * Listado de parametros general y/o por grupo
 * 
 * @author Richard Huaman <richard21hg92@gmail.com>
 */
class IndexAction extends Action
{
    /**
     * @return ActiveDataProvider
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        return $this->prepareDataProvider();
    }

    /**
     * Prepares the data provider that should return the requested 
     * collection of the models.
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider()
    {
        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }

        $proyectoId = Params::getProyectoId();

        if (!$proyectoId) {
            throw new BadRequestHttpException("Bad Request");
        }


        $modelClass = $this->modelClass;

        $query = $modelClass::find()
            ->where([
                "estado" => true
            ]);
        if (isset($requestParams['grupo'])) {
            $query->andWhere(['grupo' => $requestParams['grupo']]);
        }

        return Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $query,
            'pagination' => [
                'params' => $requestParams,
            ],
            'sort' => [
                'params' => $requestParams,
            ],
        ]);
    }
}
