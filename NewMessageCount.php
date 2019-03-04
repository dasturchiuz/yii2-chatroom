<?php

namespace dasturchiuz\chatroom;

use dasturchiuz\chatroom\models\Messages;
use yii\data\ActiveDataProvider;

class NewMessageCount extends \yii\base\Widget
{
    public $userID;

    public function run()
    {
          $data=Messages::find()->where(['receiver_id'=>$this->userID, 'is_new'=>1])->count();
         return $data > 0 ? '<span class="badge badge-danger">'.$data.'</span>' : '';
    }
}
