<div class="modal fade" id="register-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title">Registration</h3>
            </div>
            <div class="modal-body">
                <!-- <form class="form-horizontal" role="form"> -->
                <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'registor-widget-form',
                            'enableAjaxValidation'=>false,
                            'enableClientValidation'=>true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true
                            ),
                            'htmlOptions'=>array(
                              'class'=>'form-horizontal',
                              'onkeypress'=>" if(event.keyCode == 13){ jQuery('#submit-newletter').click(); }"
                            )
                        )); ?>
                    <fieldset>
                        <legend>Profile information</legend>
                        <div class="form-group">
                            <label class="col-xs-5 control-label">First Name<span class="required">*</span></label>
                            <div class="col-xs-7">
                                <?php echo $form->textField($model, 'first_name', array('class' => 'form-control'))?>
                                <?php echo $form->error($model, 'first_name')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-5 control-label">Last Name<span class="required">*</span></label>
                            <div class="col-xs-7">
                                <?php echo $form->textField($model, 'last_name', array('class' => 'form-control'))?>
                                <?php echo $form->error($model, 'last_name')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-5 col-xs-7 check-wrap">
                                <input type="checkbox" name="subcribe_newletter" id="newsletter" class="uni-check" value="subcribe_newletter" />
                                    <label for="newsletter">Subcribe to Newsletter</label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Login information</legend>
                        <div class="form-group">
                            <label class="col-xs-5 control-label">E-mail address<span class="required">*</span></label>
                            <div class="col-xs-7">
                                <?php echo $form->textField($model, 'email', array('class' => 'form-control'))?>
                                <?php echo $form->error($model, 'email')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-5 control-label">Password<span class="required">*</span></label>
                            <div class="col-xs-7">
                                <?php echo $form->passwordField($model, 'temp_password', array('class' => 'form-control'))?>
                                <?php echo $form->error($model, 'temp_password')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-5 control-label">Password confirmation<span class="required">*</span></label>
                            <div class="col-xs-7">
                                <?php echo $form->passwordField($model, 'password_confirm', array('class' => 'form-control'))?>
                                <?php echo $form->error($model, 'password_confirm')?>
                            </div>
                        </div>
                    </fieldset>
                        <div class="form-group">
                            <div class="col-xs-offset-5 col-xs-7 check-wrap">
                                <?php echo $form->checkbox($model, 'agreeTermOfUse', array('class' => 'uni-check', 'value'=>'1')); ?>
                                <!-- <input type="checkbox" id="accept" class="uni-check" /> -->
                                <?php
                                $slug = _BasePost::model()->findByPk(22);

                                ?>
                                <label for="accept">I accept the <a href="<?php echo Yii::app()->createAbsoluteUrl('cms/index', array('slug'=>$slug->slug ) ); ?>">Term and Conditions</a></label>
                                <?php echo $form->error($model, 'agreeTermOfUse')?>
                            </div>
                        </div>
                    <div class="output clearfix">
                    <!--     <button type="submit" class="btn-1 pull-right">Register</button> -->
                        <button type="button" onclick="send('#submit-newletter','#registor-widget-form','.pop-request-newletter','<?php echo Yii::app()->createAbsoluteUrl('site/ajax.Addsubscriber'); ?>');" class="btn-1 pull-right" id="submit-newletter" >
                           <?php echo Yii::t('translation', 'Submit') ?>
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
                        jQuery('#'+key+'_em_').show();
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
 }).always(function () 
 {
    jQuery(btn).button('reset');
 });
}
</script>