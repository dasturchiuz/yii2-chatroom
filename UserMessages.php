<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 2/27/19
 * Time: 9:13 AM
 */

namespace dasturchiuz\chatroom;


class UserMessages extends \yii\base\Widget
{
    public $view_link;

    public function run(){
        return $this->render("salom", ['view_link'=>$this->view_link]);
    }
}