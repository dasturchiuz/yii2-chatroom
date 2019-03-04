<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 2/28/19
 * Time: 9:38 AM
 */

namespace dasturchiuz\chatroom;

use yii\web\AssetBundle;


class ChatRoomAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dasturchiuz/yii2-chatroom/asstes';

    public $css = [

        'css/chatroom.css',
    ];
    public $js = [

        'js/chatroom.js',

    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

//    public function init()
//    {
////        $this->sourcePath = __DIR__.'/assets' ;
//        parent::init();
//    }
}
