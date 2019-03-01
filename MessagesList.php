<?php

namespace dasturchiuz\chatroom;

use dasturchiuz\chatroom\models\Messages;
use yii\data\ActiveDataProvider;

class MessagesList extends \yii\base\Widget
{
    public $userID;
    public $chatRoom;

    public function run()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Messages::find()->where(['or',
                ['sender_id'=>$this->userID],
                ['receiver_id'=>$this->userID]
            ])->groupBy('chatroom_id'),
            'pagination' => [
                'pageSize'=>20
            ]
        ]);
        return $this->render('messagechatlist', ['dataProvider' => $dataProvider, 'user_id'=>$this->userID]);
    }
}
