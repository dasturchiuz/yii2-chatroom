<?php

use yii\widgets\Pjax;

?>
<div class="container-fluid chat-container">
    <div class="row h-100">

        <div class="col-12 p-0">
            <div class="card">
                <div class="card-header bg-darkblue text-info py-1 px-2" style="flex: 1 1">
                    <div class="d-flex flex-row justify-content-start">

                        <div class="col">
                            <div class="my-0">
                                <b><?=$profile->fullnameemp?></b>
                            </div>
                            <div class="my-0">
                                <small><?=$profile->rolename; ?> </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-lightgrey d-flex flex-column p-0" style="flex: 9 1">

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
                                    return [ 'tag'=>'div', 'class'=>$model->sender_id == Yii::$app->user->identity->getId() ? 'row justify-content-end' : 'row'];
                                },
                            'itemView'=>'_itemMessage',

                        ])?>
                    <?php Pjax::end(); ?>


                    <?php $form=\yii\widgets\ActiveForm::begin()?>
                    <div class="row">
                        <div class="col-12 pt-3 pl-4 pr-4">
                            <?= $form->field($modelMessage, 'receiver_id')->hiddenInput(['value' => $profile->user_id])->label(false) ?>
                            <?=$form->field($modelMessage, 'text', [
                                'options'=>['class'=>'input-group mb-3'],
                                'template'=>"{input} 
                                <div class='input-group-append'>
                                    <button  class='btn btn-outline-secondary' type='submit'><i class='fab fa-telegram-plane fa-2x'></i></button>
                                </div> 
                                
                                "

                            ])->textInput()->label(false);?>
                        </div>
                    </div>

                    <?php \yii\widgets\ActiveForm::end();?>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
</div>
<!-- container -->
<script>
    var url_load='/my-shop/read-messages?chat_room=<?=$chatRoom?>&id=<?=$profile->user_id?>';
</script>