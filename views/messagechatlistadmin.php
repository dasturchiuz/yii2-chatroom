<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 2/27/19
 * Time: 10:37 PM
 */
use yii\widgets\ListView;
use yii\grid\GridView;
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'pager'=>[
        'options'=>['class'=>'pagination justify-content-center'],
        'linkContainerOptions'=>['class'=>'page-item'],
        'linkOptions'=>['class'=>'page-link'],
        'disabledPageCssClass'=>['class'=>'page-link'],
    ],
    'options' => [
        'class' => 'table-responsive-md',
    ],
    'layout' => "{items} \n <nav aria-label=\"Page navigation example\">{pager} </nav>",
    'tableOptions' => [
        'class' => 'table '
    ],
    'headerRowOptions' => [
        'class' => 'd-flex thead-light'
    ],
    'rowOptions'=>[
        'class'=>'d-flex',
    ],
    'columns'=>[
//        ['class'=>'yii\grid\SerialColumn'],
        [
            'label'=>'OT',
//            'contentOptions'=>[
//                'class'=>'col-md-4'
//            ],
            'headerOptions'=>[
                'class'=>'col-4'
            ],
            'contentOptions'=>[
                'class'=>'col-4'
            ],
            'value'=>function($data)use ($user_id){
                //return $user_id;
                return $data->sender_id == $user_id ? $data->receiver->username : $data->sender->username;
            }
        ],
        [
            'label'=>'Сообщение',
            'contentOptions'=>[
                'class'=>'col-6'
            ],
            'headerOptions'=>[
                'class'=>'col-6'
            ],
            'format'=>'html',
            'value'=>function($data) use($user_id, $read_link){

                return \yii\helpers\Html::a(substr($data->text, 0, 100), [$read_link, 'chat_room'=>$data->chatroom_id, 'id'=>$data->sender_id == $user_id ? $data->receiver_id : $data->sender_id, 'user_id'=>$user_id], ['class'=>'text-info']);

            }
        ],
        [
            'label'=>'Время',
            'contentOptions'=>[
                'class'=>'col-2'
            ],
            'headerOptions'=>[
                'class'=>'col-2'
            ],
            'format'=>'html',
            'value'=>function($data){
                return  "<p class='text-info'>".date('d.m.Y H:i', strtotime($data->created_at))."</p>";
            }
        ],
    ]
]);