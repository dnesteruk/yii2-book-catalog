<?php

namespace app\components\web;

use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use app\controllers\AppController;

class SecuredController extends AppController
{
    /**
     * @param Action $action
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        if (parent::beforeAction($action) && Yii::$app->user->isGuest) {
            $this->redirect(['site/login'])->send();
        }

        return true;
    }
}
