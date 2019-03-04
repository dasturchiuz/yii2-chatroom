<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 2/27/19
 * Time: 10:39 PM
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!-- Message. Default to the left -->

    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-left"><?=$model->sender->profile->fullnameemp." (".$model->sender->user_id.")"; ?></span>
        <span class="direct-chat-timestamp pull-right"><?=date('d.m.Y H:i', strtotime($model->created_at))?></span>
    </div>
    <!-- /.direct-chat-info -->
    <img class="direct-chat-img" src="<?=Url::to(['/messages/chat-room/logo', 'user_id'=>$model->sender->id])?>" ><!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        <?=$model->text?>
    </div>
    <!-- /.direct-chat-text -->

