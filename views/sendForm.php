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

                    <?php $form = ActiveForm::begin() ?>

                    <?= $form->field($model, 'receiver_id')->hiddenInput(['value' => $receiverID])->label(false) ?>
                    <?= $form->field($model, 'text')->textarea(['rows'=>8])->label(false) ?>
                    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [
                        // configure additional widget properties here
                        'template' => '<div class="form-row"> <div class="form-group col-md-4">{image}</div> <div class="form-group col-md-8">{input}</div></div>'
                    ])->label(false) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Отправить сообщение', ['class' => 'btn btn-danger btn-block']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
<script>
    var url="<?=\Yii::$app->request->referrer?>";
</script>



<?php
$js = <<<JS
    $('form').on('beforeSubmit', function(e) {
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
                        
                        $( location ).attr("href", url);
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