<?php
namespace dasturchiuz\chatroom;
use dasturchiuz\chatroom\models\Messages;

class SendMessageForm extends \yii\base\Widget
{
    public $userID;
    public $receiverID;


    public function run()
    {
        $model=new Messages();
        return $this->render('sendForm', ['model'=>$model, 'receiverID'=>$this->receiverID]);
    }
}
