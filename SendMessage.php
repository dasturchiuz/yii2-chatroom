<?php
namespace dasturchiuz\chatroom;
use dasturchiuz\chatroom\models\Messages;

class SendMessage extends \yii\base\Widget
{
    public $userID;
    public $receiverID;


    public function run()
    {
        $model=new Messages();
        return $this->render('send', ['model'=>$model, 'receiverID'=>$this->receiverID]);
    }
}
