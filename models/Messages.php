<?php

namespace dasturchiuz\chatroom\models;

use Yii;
use \app\models\User;
use dasturchiuz\chatroom\models\Chatroom;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "messages_t".
 *
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string $text
 * @property int $is_new
 * @property int $is_deleted_by_sender
 * @property int $is_deleted_by_receiver
 * @property string $created_at
 * @property int $chatroom_id
 *
 * @property Chatroom $chatroom
 * @property User $receiver
 * @property User $sender
 */
class Messages extends \yii\db\ActiveRecord
{
    public $captcha;
    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT=>['created_at'],
                ],
                'value'=>function(){ return date('Y-m-d H:i:s');},
            ],
            [
                'class'=>AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['sender_id'],
                ],
                'value' => function ($event) {
                    return Yii::$app->user->getId();
                },
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages_t';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'receiver_id', 'text', 'chatroom_id'], 'required', 'message'=>'Необходимо заполнить'],
            [['sender_id', 'receiver_id', 'is_new', 'is_deleted_by_sender', 'is_deleted_by_receiver', 'chatroom_id'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'safe'],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
            [['chatroom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chatroom::className(), 'targetAttribute' => ['chatroom_id' => 'id']],
            ['captcha', 'captcha', 'message'=>"Необходимо заполнить проверочный код."]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sender_id' => Yii::t('app', 'Sender ID'),
            'receiver_id' => Yii::t('app', 'Receiver ID'),
            'text' => Yii::t('app', 'Text'),
            'is_new' => Yii::t('app', 'Is New'),
            'is_deleted_by_sender' => Yii::t('app', 'Is Deleted By Sender'),
            'is_deleted_by_receiver' => Yii::t('app', 'Is Deleted By Receiver'),
            'created_at' => Yii::t('app', 'Created At'),
            'chatroom_id' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatroom()
    {
        return $this->hasOne(Chatroom::className(), ['id' => 'chatroom_id']);
    }


    //joriy yozishmaga chat xonasi ochilgan yuqligini telshiradi
    public function CheckChatRoom($receiver_id, $user_id){
        $data=self::find()->where(['or', ['receiver_id'=>$receiver_id, 'sender_id'=>$user_id], ['receiver_id'=>$user_id, 'sender_id'=>$receiver_id]])->groupBy('chatroom_id')->one();
        if(!empty($data)){

            return $data->chatroom_id;
        }else{
            $model=new ChatRoom();
            $model->sts=1;
            $model->save(false);
            return $model->id;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }

    public static function MarkAsRead($id){
        $model=self::findOne($id);
        $model->is_new=0;
        return $model->save(false);
    }
}