<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'interior-design-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
		)); ?>
			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model,'interior_name', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model,'interior_name', array('class' => 'form-control', 'maxlength' => 255)); ?>
					<?php echo $form->error($model,'interior_name'); ?>
				</div>
			</div>
			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model,'email', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model,'email', array('class' => 'form-control', 'maxlength' => 255)); ?>
					<?php echo $form->error($model,'email'); ?>
				</div>
			</div>
    
			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model,'feature_designer', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->dropDownList($model,'feature_designer', $model->optionFeature, array('empty'=>'Select','class' => 'form-control')); ?>
					<?php echo $form->error($model,'feature_designer'); ?>
				</div>
			</div>

			<div class='form-group form-group-sm' id="showOrder" style="display:none; <?php if($model->feature_designer==1) echo "display:block;" ?>" >
				<?php echo $form->labelEx($model,'order_featured', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model,'order_featured', array('class' => 'form-control validate-number', 'maxlength' => 255)); ?>
					<?php echo $form->error($model,'order_featured'); ?>
				</div>
			</div>

			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model,'established', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model,'established', array('class' => 'form-control', 'maxlength' => 255)); ?>
					<?php echo $form->error($model,'established'); ?>
				</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'address', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'address', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'address'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model,'logo', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
				<?php
				if (!empty($model->logo)) { ?>
						<div class="thumbnail">
							<img src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . "/".$model->id."/120x120/".$model->logo);?>"  />
						</div>
				<?php } ?>
				<?php echo $form->fileField($model, 'logo', array('accept' => 'image/*', 'class' => 'form-control', 'title' => 'Upload  ' . $model->getAttributeLabel('logo'))); ?>
					<div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize/1024)/1024;?>M </div>
					<?php echo $form->error($model,'logo'); ?>
				</div>
			</div>
			
			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model,'present_image', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
				<?php
				if (!empty($model->present_image)) { ?>
						<div class="thumbnail">
							<img src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . "/".$model->id."/205x182/".$model->present_image);?>" />
						</div>
				<?php } ?>
				<?php echo $form->fileField($model, 'present_image', array('accept' => 'image/*', 'class' => 'form-control', 'title' => 'Upload  ' . $model->getAttributeLabel('present_image'))); ?>
					<div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize/1024)/1024;?>M </div>
					<?php echo $form->error($model,'present_image'); ?>
				</div>
			</div>



    
			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model,'warranty_after_sale_service', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
					<?php echo $form->textField($model,'warranty_after_sale_service', array('class' => 'form-control', 'maxlength' => 255)); ?>
					<?php echo $form->error($model,'warranty_after_sale_service'); ?>
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
					<?php echo $form->labelEx($model,'description', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-9">
						<?php echo $form->textArea($model,'description', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'description'); ?>
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

<script>
	function validateNumber() {
	    $(".validate-number").keypress(function (e) {
	        switch (e.keyCode) {
	            default:
	                if (String.fromCharCode(e.which).match(/[^0-9]/g))
	                    return false;
	        }
	    });
	}

	$('#InteriorDesign_feature_designer').change(function(){
		if($(this).val()==1){
			$('#showOrder').show();
		}else{
			$('#InteriorDesign_order_featured').val('');
			$('#showOrder').hide();
		}
	})

	validateNumber();

</script>