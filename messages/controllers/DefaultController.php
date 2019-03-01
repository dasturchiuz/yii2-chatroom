<?php

namespace dasturchiuz\chatroom\messages\controllers;

use yii\web\Controller;
use dasturchiuz\chatroom\messages\ModuleTrait;
class DefaultController extends Controller
{
    use ModuleTrait;
    public function actionIndex()
    {
        $roles=$this->getModule()->roles;
        return $this->render('index', compact('roles'));
    }
}
