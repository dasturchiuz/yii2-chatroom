<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 2/27/19
 * Time: 8:37 AM
 */

namespace dasturchiuz\chatroom\messages;


use yii\db\Exception;

trait ModuleTrait
{
    public $_module;

    public function getModule(){
        if($this->_module==null){
            $this->_module=\Yii::$app->getModule('messages');
        }

        if(!$this->_module){
            throw new Exception("\n\n\n\n\n Module topilmadi \n\n\n\n\n");
        }

        return $this->_module;

    }
}