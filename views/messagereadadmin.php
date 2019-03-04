<?php

use yii\widgets\Pjax;

?>
<div class="direct-chat-messages">
    <?php Pjax::begin(['id' => 'messages_conversation', 'enablePushState' => true ]); ?>
    <?=\yii\widgets\ListView::widget([
        'dataProvider'=>$dataProvider,

        'pager'=>[
            'options'=>['class'=>'pagination justify-content-center'],
            'linkContainerOptions'=>['class'=>'page-item'],
            'linkOptions'=>['class'=>'page-link'],
            'disabledPageCssClass'=>['class'=>'page-link'],
        ],
        'options' => [
            'tag' => 'div',
            'class' => 'container-fluid message-scroll',
            'id' => '',
            'style' => 'flex: 1 1',
            'data-pjax' => true
        ],
        'layout' => "<div class='mt-2'>{pager}</div>\n{items}\n{pager}",
        'itemOptions'=>function($model, $key, $index, $widget) use($user_id){
            if($model->receiver_id==$user_id && $model->is_new==1){
                \dasturchiuz\chatroom\models\Messages::MarkAsRead($model->id);
            }
            return [ 'tag'=>'div', 'class'=>$model->sender_id==$user_id ? 'direct-chat-msg right' : 'direct-chat-msg'];
        },
        'itemView'=>'_itemMessageAdmin',

    ])?>
    <?php Pjax::end(); ?>

</div>

<!-- container -->
<script>
    var url_load='/my-shop/read-messages?chat_room=<?=$chatRoom?>&id=<?=$profile->user_id?>';
</script>