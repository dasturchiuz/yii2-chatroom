<?php
namespace dasturchiuz\chatroom\messages\controllers;

use yii\web\Controller;
use dasturchiuz\chatroom\messages\ModuleTrait;
use yii\filters\AccessControl;
class ChatRoomController  extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [

                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    //ushbu method xabarlarni qo'shsih uchun
    public function actionSendmessage(){
        $model = new \dasturchiuz\chatroom\models\Messages();

        if(\Yii::$app->request->isAjax)
        {
             if($model->load(\Yii::$app->request->post())){
                 $model->chatroom_id=$model->CheckChatRoom($model->receiver_id, \Yii::$app->user->identity->getId());
                 $model->save(false);
                 return true;
             }
        }
    }

}