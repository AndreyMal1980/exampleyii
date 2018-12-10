<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$model = new \app\models\CallbackMasterForm ;
 
        ?>
<div style="display: none">
    <div class="box-modal" id="modal-callback">
        <div class="box-modal_close arcticmodal-close">закрыть</div>
        <h1 class="text-center">Вызвать мастера</h1>

        <?php $form = ActiveForm::begin(['id' => 'callback-master-form','action' => yii\helpers\Url::toRoute('/user/callbackmaster')]); ?>

        <div class="form-group">
            <?= $form->field($model, 'username')->label('')->textInput(['autofocus' => true, 'placeholder' => 'Ваше имя']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'phone')->label('')->textInput(['autofocus' => true, 'placeholder' => 'Телефон']) ?>
        </div>

         <div class="form-group">         
                            <?= Html::submitButton('Отправить', ['class' => ' btn btn-info btn-md', 'name' => 'usluga-button']) ?>
                     
                    </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>


<script>
    $(function(){
$('.call-master').on('click', function () {
        $('#modal-callback').arcticmodal({
        });
    });
    /*
    $('.callbackmasterform').on('click',function(){
         var username = $('#user-username').val();
         var phone = $('#user-phone').val();*/
      //   alert(name);
        //  alert(phone);
   
    /*$.ajax({
                type: 'POST',
                url: "<?php /*\yii\helpers\Url::toRoute(['/user/callbackmaster']) */?>",
                data: {username: username, phone: phone},
                before:function(username,phone){
                    if(!username || !phone)
                        alert('Заполните поля');
                  },
                success: function (data) {
                   console.log(data);
                },
                error: function (data) {
                    alert('Возникла ошибка');
                }
            });
          });*/
  });

</script>