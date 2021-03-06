<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'interior-design-license-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
		)); ?>
			
			<div class='form-group form-group-sm'>
				<?php echo $form->labelEx($model,'image', array('class' => 'col-sm-1 control-label')); ?>
				<div class="col-sm-3">
				<?php
				if (!empty($model->image)) { ?>
						<div class="thumbnail">
							<img src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . "/".$model->id."/".$model->image);?>"  style="width:100%;" />
						</div>
				<?php } ?>
				<?php echo $form->fileField($model, 'image', array('accept' => 'image/*', 'class' => 'form-control', 'title' => 'Upload  ' . $model->getAttributeLabel('image'))); ?>
					<div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize/1024)/1024;?>M </div>
					<?php echo $form->error($model,'image'); ?>
				</div>
			</div>    

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-1 control-label')); ?>
					<div class="col-sm-3">
						<?php echo $form->dropDownList($model,'status', $model->optionActive, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
					</div>
			</div>
    
			<?php echo $form->hiddenField($model,'designer_id',array('value'=>$this->designerId->id)); ?>
			<div class="clr"></div>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
				<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl . '\'')); ?>
			</div>
		<?php $this->endWidget(); ?>
		</div>
	</div>
</div>