<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/bootstrap-multiselect.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#PropertyListing_position').multiselect();
        $('#PropertyListing_property_type_id').multiselect();
        $('#PropertyListing_floor_area_id').multiselect();
        $('#PropertyListing_condition_id').multiselect();
    });
</script>
<div class="panel panel-default">
  <div class="panel-body">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'search-form'),
	)); ?>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'title', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'title', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'title'); ?>
					</div>
				</div>
			</div>
                        <div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'position', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'position', $model->positionOption, array('class' => 'form-control', 'multiple' => "multiple")); ?>
						<?php echo $form->error($model,'position'); ?>
					</div>
				</div>
			</div>
                        <div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'property_type_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'property_type_id', PropertyType::getList(), array('class' => 'form-control', 'multiple' => "multiple")); ?>
						<?php echo $form->error($model,'property_type_id'); ?>
					</div>
				</div>
			</div>
                        <div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'condition_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'condition_id', MasterCondition::getList(), array('class' => 'form-control', 'multiple' => "multiple")); ?>
						<?php echo $form->error($model,'condition_id'); ?>
					</div>
				</div>
			</div>
                        <div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'floor_area_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'floor_area_id', MasterFloorArea::model()->getDropdownlistWithTable(array('status'=>STATUS_ACTIVE), 'id', 'from_to'), array('class' => 'form-control', 'multiple' => "multiple")); ?>
						<?php echo $form->error($model,'floor_area_id'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'status', $model->optionActive, array('empty' => 'All', 'class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
					</div>
				</div>
			</div>
	<div class="col-sm-12">
		<div class="well">
			<?php echo CHtml::htmlButton('<span class="' . $this->iconSearch .  '"></span> Search', array('class' => 'btn btn-default btn-sm', 'type' => 'submit')); ?>			
			<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Clear', array('class' => 'btn btn-default btn-sm', 'type' => 'reset', 'id' => 'clearsearch')); ?>
		</div>
	</div> 
	<?php $this->endWidget(); ?>

	</div>
</div>

