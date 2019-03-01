<?php

namespace dasturchiuz\chatroom\messages;

use \yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'dasturchiuz\chatroom\messages\controllers';

    public $roles=[];
    public $layout = 'main';
    const VERSION = '1.0.0-dev';

    public function init()
    {
        parent::init();
    }

    public function getImage($item){

    }
}