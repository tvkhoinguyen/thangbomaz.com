<div class="modal fade" id="login-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title">Sign in</h3>
            </div>
            <div class="modal-body">
                <!-- <form class="form-horizontal" role="form"> -->
                <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'login-widget-form',
                            // 'action' => Yii::app()->createAbsoluteUrl('site/login'),
                            'enableAjaxValidation'=>false,
                            'enableClientValidation'=>true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true
                            ),
                            'htmlOptions'=>array(
                              'class'=>'form-horizontal',
                              'role'=>'form',
                              // 'onsubmit'=>"return send('#submit-login','#login-widget-form','.pop-request-newletter','".Yii::app()->createAbsoluteUrl('site/ajaxlogin.Addsubscriber')."');",
                              'onkeypress'=>" if(event.keyCode == 13){ jQuery('#submit-login').click(); }"
                            )
                        )); ?>

                    <div class="form-group">
                        <label class="col-xs-4 control-label">E-mail address</label>
                        <div class="col-xs-8">
                            <!-- <input type="text" class="form-control" /> -->
                            <!--<span class="error">Error message</span>-->
                            <?php echo $form->textField($model, 'email', array('class' => 'form-control'))?>
                                <?php echo $form->error($model, 'email')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Password</label>
                        <div class="col-xs-8">
                            <!-- <input type="password" class="form-control" /> -->
                            <!--<span class="error">Error message</span>-->
                            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control'))?>
                                <?php echo $form->error($model, 'password')?>
                        </div>
                    </div>
                    <div class="output clearfix">
                        <a href="<?php echo Yii::app()->createAbsoluteUrl("site/forgotPassword"); ?>" class="forgot-password">Forgot password?</a>
                        <!-- <button type="submit" class="btn-1 pull-right">Login</button> -->
                        <button type="button" onclick="send('#submit-login','#login-widget-form','.pop-request-newletter','<?php echo Yii::app()->createAbsoluteUrl('site/ajaxlogin.Addsubscriber'); ?>');" class="btn-1 pull-right" id="submit-login" data-loading-text="<?php echo Yii::t('translation', 'Login') ?>" >
                           <?php echo Yii::t('translation', 'Login') ?>
                         </button>
                    </div>
                <!-- </form> -->
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
function send(btn,form,ContentHtml,link)
{
 var data=jQuery(form).serialize();
 // jQuery(btn).button('loading');
 // jQuery(btn).prop('disabled', true); 
 jQuery.ajax({
        type: 'POST',
        url: link,
        async:true,
        data:data,
        dataType:'html',
        beforeSend: function() 
        {
                $.blockUI({ message: null });
        },
        success:function(datajson)
        {
            var obj = jQuery.parseJSON( datajson );
                
               if(obj.status == 'error')
               {
                    $.unblockUI();
                    var errors = jQuery.parseJSON( obj.data );
                    console.log(obj.data);
                    jQuery.each(errors, function(key, val) 
                    {
                        jQuery('#'+key+'_em_').text(val[0]);                                                    
                        jQuery('#'+key+'_em_').show()
                    });  
               }else if(obj.status == 'success')
               {

                    console.log(obj.data);
                    // window.location.reload();
                    // window.location.href = '<?php echo Yii::app()->createAbsoluteUrl("site/index"); ?>';
                    window.location.href = obj.data;
                    $.unblockUI();
               }
        },
        error: function(data)
        {
            $.unblockUI();
            console.log(data);
        }
 })
 .always(function () 
 {
    jQuery(btn).button('reset');
 });
}
</script>