<?php

namespace dasturchiuz\chatroom;

use dasturchiuz\chatroom\models\Messages;
use yii\data\ActiveDataProvider;

class MessageListAdmin extends \yii\base\Widget
{
    public $userID;
    public $chatRoom;
    public $read_link;

    public function run()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Messages::find()->select("id, MAX(created_at) as created_at, sender_id, receiver_id, MAX(text) as text, chatroom_id, is_new")->where(['or',
                ['sender_id'=>$this->userID],
                ['receiver_id'=>$this->userID]
            ])->groupBy('chatroom_id'),
            'pagination' => [
                'pageSize'=>20
            ],
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);
        return $this->render('messagechatlistadmin', ['dataProvider' => $dataProvider, 'user_id'=>$this->userID, 'read_link'=>$this->read_link]);
    }
}
