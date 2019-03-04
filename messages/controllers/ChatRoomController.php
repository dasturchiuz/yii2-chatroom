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

    public function actionLogo($user_id)
    {
        $model=\app\models\Profile::findOne($user_id);
        if(!empty($model->logo))
            return $model->logo->logo;
        else
            return \Yii::$app->response->sendFile(\Yii::getAlias("@app")."/web/images/default-avatar.png")->send();
    }

}