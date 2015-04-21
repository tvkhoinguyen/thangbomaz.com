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
					<div class="col-sm-3">
						<?php echo $form->textField($model,'title', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'title'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'short_content', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textArea($model,'short_content', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'short_content'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'content', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textArea($model,'content', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'content'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'image', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
					<?php
					if (!empty($model->image)) { ?>
							<div class="thumbnail">
								<div class="caption">
								<h4><?php echo $model->getAttributeLabel('image');?></h4>
								<p>Click on remove button to remove <?php echo $model->getAttributeLabel('image');?></p>
								<a href="<?php echo $this->baseControllerIndexUrl();?>/removeimage/fieldName/image/id/<?php echo $this->id;?>" class="label label-danger removedfile" rel="tooltip" title="Remove">Remove</a>
								</div>
								<img src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . "/".$model->id."/".$model->image);?>"  style="width:100%;" />
							</div>
					<?php } ?>
					<?php echo $form->fileField($model, 'image', array('accept' => 'image/*', 'class' => 'form-control', 'title' => 'Upload  ' . $model->getAttributeLabel('image'))); ?>
						<div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize/1024)/1024;?>M </div>
						<?php echo $form->error($model,'image'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'get_from', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'get_from', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'get_from'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'category_parent_id', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'category_parent_id', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'category_parent_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'category_sub_id', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'category_sub_id', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'category_sub_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'user_id', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'user_id', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'user_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'order_display', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'order_display', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'order_display'); ?>
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
					<?php echo $form->labelEx($model,'view', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'view', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'view'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'slug', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'slug', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'slug'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_home', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'is_home', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'is_home'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_default', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'is_default', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'is_default'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'updated_date', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->textField($model,'updated_date', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'updated_date'); ?>
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