<?php

namespace dasturchiuz\chatroom\models;

use Yii;
use \app\models\User;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "chatroom".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int $sts
 *
 * @property User $createdBy
 * @property MessagesT[] $messagesTs
 */
class Chatroom extends \yii\db\ActiveRecord
{
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
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_by'],
                ],
                'value' => function ($event) {
                    return Yii::$app->user->getId();
                },
            ],
        ];
    }
    /**
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chatroom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'sts'], 'required'],
            [['created_at', 'created_by', 'sts'], 'integer'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'sts' => Yii::t('app', 'Sts'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagesTs()
    {
        return $this->hasMany(MessagesT::className(), ['chatroom_id' => 'id']);
    }
}