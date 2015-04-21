<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'tin-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
		)); ?>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'title', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-8">
						<?php echo $form->textField($model,'title', array('class' => 'form-control', 'maxlength' => 60)); ?>
						<?php echo $form->error($model,'title'); ?>
						<div class="note">Note: max lenght 60.</div>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'short_content', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-8">
						<?php //echo $form->textArea($model,'short_content', array('class' => 'ver_editor_basic', 'cols' => 63, 'rows' => 5)); ?>
						<?php //echo $form->textField($model,'short_content', array('class' => 'my-editor-basic-nguyen', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->textField($model,'short_content', array('class' => 'form-control', 'maxlength' => 160)); ?>
						<?php echo $form->error($model,'short_content'); ?>
						<div class="note">Note: max lenght 160.</div>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'content', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-8">
						<?php echo $form->textArea($model,'content', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'content'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'image', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
					<?php
					if (!empty($model->image)) { ?>
								<img src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . "/".$model->id."/".$model->image);?>"  style="width:100%;" />
					<?php } ?>
					<?php echo $form->fileField($model, 'image', array('accept' => 'image/*', 'class' => 'form-control', 'title' => 'Upload  ' . $model->getAttributeLabel('image'))); ?>
						<div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize/1024)/1024;?>M </div>
						<?php echo $form->error($model,'image'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'category_parent_id', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->dropDownList($model,'category_parent_id', array(''=>'---Select---')+ CategoryTin::getListData(), array(
								'class' => 'form-control',
								'onchange' => '
												loadSubMenu(this.value);
							                   ',

								)); ?>
						<?php echo $form->error($model,'category_parent_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<label class="col-sm-1 control-label" for="ThoiSu_category_sub_id">Category Sub</label>
					<div class="col-sm-3" id="result_subMenu">
						<?php
						if(!empty($model->category_parent_id))
						{ ?>
						<?php echo $form->dropDownList($model,'category_sub_id', CategoryTin::getSubListData($model->category_parent_id), array('class' => 'form-control')); ?>
						<?php }
						?>
					</div>
			</div>
    
    		<?php
    		$_tmp = array();
    		for($i=1; $i<=100; $i++ )
    			$_tmp[$i] = $i;
    		?>
    		<div class='form-group form-group-sm'>
    				<?php echo $form->labelEx($model, 'order_display', array('class' => 'col-sm-1 control-label')); ?>
    				<div class="col-sm-3">
    					<?php echo $form->dropDownList($model,'order_display',$_tmp , array('class' => 'form-control') ); ?>
    					<?php echo $form->error($model, 'order_display'); ?>
    				</div>
    		</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->dropDownList($model,'status', $model->optionActive, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
					</div>
			</div>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_home', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->dropDownList($model,'is_home', $model->optionYesNo, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_home'); ?>
					</div>
			</div>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_default', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->dropDownList($model,'is_default', $model->optionYesNo, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_default'); ?>
					</div>
			</div>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_hot', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->dropDownList($model,'is_hot', $model->optionYesNo, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_hot'); ?>
					</div>
			</div>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_marquee', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->dropDownList($model,'is_marquee', $model->optionYesNo, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_marquee'); ?>
					</div>
			</div>
    
			<div class="clr"></div>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
				<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
			</div>
		<?php $this->endWidget(); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	function loadSubMenu(value)
	{
		 $.ajax({
		    url: '<?php echo Yii::app()->createAbsoluteUrl("ajax/getSubMenuCategory"); ?>',
		    data:{'parent_id' : value},
		    type: 'POST',
		    beforeSend: function() 
		    {
		    },
		    success: function(data) 
		    {
		        if(data != "") 
		        {
		        	$('#result_subMenu').html(data);
		        }else{
		        	$('#result_subMenu').html('');
		        }
		    },
		    error: function(data) 
		    {
		    }
		});
	}
</script>