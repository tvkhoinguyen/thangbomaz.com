<div class="main clearfix">
	<div class="breadcrumb"><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a> <strong>Request for Quote</strong></div>
    <h1 class="title-2">Request for Quote</h1>
    <!-- <form class="form-horizontal" role="form"> -->

    <?php if (Yii::app()->user->hasFlash('msg')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
             <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                 <?php echo Yii::app()->user->getFlash('msg'); ?>
        </div>
    <?php endif; ?> 

    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'request-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>false,
            'clientOptions' => array(
                'validateOnSubmit' => true
            ),
            'htmlOptions'=>array(
              'class'=>'form-horizontal', 
              'role'=>'form',
              'enctype' => 'multipart/form-data'
            )
        )); ?>

        <fieldset>
        	<legend>Personal Information</legend>
            <div class="form-group">
                <label class="col-xs-3 control-label">Title:</label>
                <div class="col-xs-2">
                    <!-- <select class="selectpicker">
                        <option>Mr.</option>
                        <option>Ms.</option>
                    </select> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->dropDownList($model,'title', Salutations::model()->getList(), array('class'=>'selectpicker')); ?>
                    <?php echo $form->error($model,'title'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">First Name<span class="required">*</span>:</label>
                <div class="col-xs-5">
                    <!-- <input type="text" class="form-control" /> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->textField($model, 'first_name', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'first_name')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Last Name<span class="required">*</span>:</label>
                <div class="col-xs-5">
                    <!-- <input type="text" class="form-control" /> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->textField($model, 'last_name', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'last_name')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Email Addreess<span class="required">*</span>:</label>
                <div class="col-xs-5">
                    <!-- <input type="text" class="form-control" /> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'email')?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Contact Number:</label>
                <div class="col-xs-5">
                    <!-- <input type="text" class="form-control" /> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->textField($model, 'phone', array('class' => 'form-control'))?>
                    <?php echo $form->error($model, 'phone')?>
                </div>
            </div>
    	</fieldset>
        <fieldset>
        	<legend>PRINTING Information</legend>
            <div class="form-group">
                <label class="col-xs-3 control-label">Type of Solution<span class="required">*</span>:</label>
                <div class="col-xs-5 ">

                    <!-- <input type="text" class="form-control" /> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->dropDownList($model,'type_of_solution', array(''=>'---Select---') + Request::$type_of_solution, 
                        array(
                            'onchange'=>'ajaxGetCategory(this.value)',
                            'class'=>'selectpicker',
                            ) ); ?>
                    <?php echo $form->error($model,'type_of_solution'); ?>
                </div>
            </div>
    <?php
    if(!empty($model->type_of_solution) && $model->type_of_solution==1 )
    {
        // echo '<div id="show_category" style="display:none;">';
        echo '<div id="show_category" >';
    }else if(!empty($model->type_of_solution))
    {
        echo '<div id="show_category">';
    }else if( empty($model->type_of_solution)){
        echo '<div id="show_category" style="display:none;">';
    }
    ?>
            <div class="form-group">
                <label class="col-xs-3 control-label">Category<span class="required">*</span>:</label>
                <div class="col-xs-5 custom-select">
                    <?php 
                    if( !empty($model->type_of_solution) && $model->type_of_solution==1)
                    {
                        $criteria=new CDbCriteria;
                        $criteria->compare('status',STATUS_ACTIVE);
                        $criteria->order = 'ordering ASC';
                        $models_tmp = PrintCategories::model()->findAll($criteria);
                        $html ='';
                        // <select class="selectpicker" name="Request[type_of_solution]" id="Request_type_of_solution" ><option value="" selected="selected">---Select---</option><option value="1">Print Solutions</option><option value="2">Design Solutions</option><option value="3">Dislay Solutions</option></select>
                        $html = $html . '<select class="selectpicker" name="Request[category]" id="Request_category" >';
                        if(!empty($models_tmp))
                        {
                            foreach ($models_tmp as $one) 
                            {
                                if($one->name == $model->category)
                                    $html = $html. '<option selected="selected" value="'.$one->name.'">'.$one->name.'</option>';
                                else
                                    $html = $html. '<option value="'.$one->name.'">'.$one->name.'</option>';
                            }
                        }
                        $html = $html.'</select>';
                        echo $html;

                    }else if( !empty($model->type_of_solution) )
                    {
                        echo $form->textField($model, 'category', array('class' => 'form-control'));
                        echo $form->error($model, 'category');
                    }
                    ?>
                    <!-- <input class="form-control" name="Request[category]" id="Request_category" type="text" maxlength="200"> -->
                    <!-- <input type="text" class="form-control" /> -->
                    <!--<span class="error">Error message</span>-->
                    <!-- <select id="Request_category" name="Request[category]" class="selectpicker" >
                            
                    </select> -->
                </div>
            </div>
    </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Brief your print requirements<span class="required">*</span>:</label>
                <div class="col-xs-5">
                    <!-- <input type="text" class="form-control" /> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->textArea($model, 'print_requirement', array('class' => 'form-control', 'cols' => 63, 'rows' => 5 ))?>
                    <?php echo $form->error($model, 'print_requirement'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Preffered Collection Date:</label>
                <div class="col-xs-5" >
                	<!-- <div class="row in-row">
                        <div class="col-xs-3 col">
                            <select class="selectpicker">
                                <option>1</option>
                                <option>2</option>
                            </select>
                    	</div>
                        <div class="col-xs-6 col">
                            <select class="selectpicker">
                                <option>January</option>
                                <option>February</option>
                            </select>
                    	</div>
                        <div class="col-xs-3 col">
                            <select class="selectpicker">
                                <option>2014</option>
                                <option>2013</option>
                            </select>
                    	</div>
                    </div> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->textField($model,'collect_date2', array('class' => 'my-datepicker-control-dd-mm-yy form-control', 'readonly'=>'readonly', 'style'=>'width: 90%; float: left;')); ?>
                    <?php echo $form->error($model, 'collect_date2'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Attachments:</label>
                <div class="col-xs-5">
                    <!-- <input type="text" class="form-control" /> -->
                    <!--<span class="error">Error message</span>-->
                    <?php echo $form->fileField($model, 'attachment', array('class' => 'form-control2'))?>
                    <?php echo $form->error($model, 'attachment')?>
                    <div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowUploadType); ?> - Maximum file size : <?php echo ($model->maxUploadFileSize/1024)/1024;?>M </div>
                </div>
            </div>
            <div class="form-group output">
                <div class="col-xs-offset-3 col-xs-5">
                	<button type="reset" class="btn-2">clear</button>
                	<button type="submit" class="btn-1">submit</button>
                </div>
            </div>
    	</fieldset>
    <!-- </form> -->
    <?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    function ajaxGetCategory(id)
    {
        if(id==1)
        {
            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl("site/ajaxGetPrintSolutionCategory"); ?>',
                data:{
                },
                type: 'POST',
                beforeSend: function() {
                    $.blockUI({ message: null });
                    // $('#show_category').hide();
                },
                success: function(data) 
                {
                    $.unblockUI();
                    console.log(data);
                        $('.custom-select').html(data);
                       // $('#Request_category').html(data);
                        $('.uni-radio, .uni-check, .uni-select').uniform();
                        $('.selectpicker').selectpicker();
                        $('#show_category').show();
                    // if( $.trim(data)=='delete_success')
                        // window.location.href = refresh;
                    
                },
                error: function(data) 
                {
                    $.unblockUI();
                    console.log(data);
                    // window.location.href = refresh;
                    $('#show_category').hide();
                }
            });

            
        }else
        {
            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl("site/ajaxGetPrintSolutionCategoryTextBox"); ?>',
                data:{
                },
                type: 'POST',
                beforeSend: function() {
                    $.blockUI({ message: null });
                    // $('#show_category').hide();
                },
                success: function(data) 
                {
                    $.unblockUI();
                    console.log(data);
                        $('.custom-select').html(data);
                       // $('#Request_category').html(data);
                        // $('.uni-radio, .uni-check, .uni-select').uniform();
                        // $('.selectpicker').selectpicker();
                        $('#show_category').show();
                    // if( $.trim(data)=='delete_success')
                        // window.location.href = refresh;
                    
                },
                error: function(data) 
                {
                    $.unblockUI();
                    console.log(data);
                    // window.location.href = refresh;
                    // $('#show_category').hide();
                }
            });

            // $('.custom-select').html('');
            // $('#show_category').hide();
        }
    }
</script>