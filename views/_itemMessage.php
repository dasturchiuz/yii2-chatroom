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


    <div class="card message-card m-2">
        <div class="card-body p-2">
            <span class="mx-2"><?=$model->text?></span>
            <span class="float-right mx-1"><small><?=date('d.m.Y H:i', strtotime($model->created_at))?> <?=$model->is_new==1 ? '<i class="fas fa-eye fa-fw" style="color:#e64980"></i>' : '<i class="fas fa-check fa-fw" style="color:#66a80f"></i>'?></small></span>
        </div>
    </div>

