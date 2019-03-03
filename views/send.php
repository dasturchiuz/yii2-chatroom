<?php
/**
 * Created by PhpStorm.
 * User: loock
 * Date: 2/27/19
 * Time: 10:19 AM
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
   <p class="text-info text-center"> <i class="fa fa-envelope" aria-hidden="true"></i>
<?=\yii\helpers\Html::a('Отправить сообщение', ['#'], ['data-toggle'=>"modal", 'class'=>'font-weight-bold ', 'data-target'=>"#sendMessage"])?></p>
    
    
    <div class="modal fade" id="sendMessage">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ОТПРАВИТЬ СООБЩЕНИЕ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(['id'=>'sendmessageform']) ?>

                    <?= $form->field($model, 'receiver_id')->hiddenInput(['value' => $receiverID])->label(false) ?>
                    <?= $form->field($model, 'text')->textarea()->label(false) ?>
                    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [
                        // configure additional widget properties here
                        'template' => '<div class="form-row"> <div class="form-group col-md-4">{image}</div> <div class="form-group col-md-8">{input}</div></div>'
                    ])->label(false) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Отправить сообщение', ['class' => 'btn btn-danger btn-block']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>



<?php
$js = <<<JS
    $('#sendmessageform').on('beforeSubmit', function(e) {
      console.log($(this).serialize());
      $.ajax({
        url : '/messages/chat-room/sendmessage',
        type : 'POST',
        data: $(this).serialize(),
        success: function(data) {
                             $('#sendMessage').modal('hide');

            if(data==1){
runNotify({
                        type: 'notify',
                        message: 'Сообщение успешно отправлено!',
                        levelMessage: 'success'
                        });
            }else {
                runNotify({
                        type: 'notify',
                        message: 'Cообщение не отправлено пожалуйста повторить попытку',
                        levelMessage: 'error'
                        });
            }
         
        },
        error: function() {
           $('#sendMessage').modal('hide');
runNotify({
                        type: 'notify',
                        message: 'Cообщение не отправлено пожалуйста повторить попытку',
                        levelMessage: 'error'
                        });
        }
      });

      return false;

    });

JS;

$this->registerJs($js, yii\web\View::POS_READY);


?>