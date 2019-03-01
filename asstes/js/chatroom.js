$(document).ready(function(){
   //$("#wait-message")


      $('form').on('beforeSubmit', function(e) {
         console.log($(this).serialize());
         $("#wait-message").show();
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
                  $("#messages-text").val("");
                  $.pjax.reload({
                     container: '#messages_conversation',
                     url:url_load
                  });

               }else {
                  runNotify({
                     type: 'notify',
                     message: 'Cообщение не отправлено пожалуйста повторить попытку',
                     levelMessage: 'error'
                  });
               }
               $("#wait-message").hide();
            },
            error: function() {
               $("#wait-message").hide();
               runNotify({
                  type: 'notify',
                  message: 'Cообщение не отправлено пожалуйста повторить попытку',
                  levelMessage: 'error'
               });
            }
         });

         return false;

      });

});