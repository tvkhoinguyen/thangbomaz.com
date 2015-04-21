<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'property-listing-form',
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
                            <?php echo $form->labelEx($model, 'description', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-8">
                                    <?php echo $form->textArea($model, 'description', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
                                    <?php echo $form->error($model, 'description'); ?>
                            </div>
			</div>		
                        
			<h4>Details:</h4>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'property_price', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->textField($model,'property_price', array('class' => 'form-control', 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model,'property_price'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'price', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->textField($model,'price', array('class' => 'form-control', 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model,'price'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'property_type_id', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->dropDownList($model,'property_type_id', PropertyType::getList(), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'property_type_id'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'floor_area_id', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->dropDownList($model,'floor_area_id', MasterFloorArea::model()->getDropdownlistWithTable(array('status' => STATUS_ACTIVE), 'id', 'from_to', 'display_order'), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'floor_area_id'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'condition_id', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->dropDownList($model,'condition_id', MasterCondition::getList(), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'condition_id'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'developer_id', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->dropDownList($model,'developer_id', MasterDeveloper::getList(), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'developer_id'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'tenure_id', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->dropDownList($model,'tenure_id', MasterTenures::getList(), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'tenure_id'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'lease_term_id', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->dropDownList($model,'lease_term_id', MasterLeaseTerm::getList(), array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'lease_term_id'); ?>
                            </div>
			</div>
                        
                        <h4>Contact Details:</h4>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'contact_name', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->textField($model,'contact_name', array('class' => 'form-control', 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model,'contact_name'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'contact_number', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->textField($model,'contact_number', array('class' => 'form-control', 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model,'contact_number'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'cea_reg', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->textField($model,'cea_reg', array('class' => 'form-control', 'maxlength' => 255)); ?>
                                    <?php echo $form->error($model,'cea_reg'); ?>
                            </div>
			</div>
                    
			<div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model, 'featured_image', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                            <?php if ($model->featured_image != '') { ?>
                                    <div class="thumbnail" id="thumbnail-<?php echo $model->id; ?>">
                                        <div class="caption">
                                            <h4><?php echo $model->getAttributeLabel('lfeatured_image'); ?></h4>
                                            <p>Click on remove button to remove <?php echo $model->getAttributeLabel('featured_image'); ?></p>
                                            <p><a href="<?php echo $this->baseControllerIndexUrl(); ?>/removeimage/fieldName/featured_image/id/<?php echo $model->id; ?>" class="label label-danger removedfile" rel="tooltip" title="Remove">Remove</a>
                                        </div>
                                        <img src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/' . $model->id . '/' . $model->featured_image); ?>"  style="width:100%;" />
                                    </div>
                                            <?php } ?>
                                <?php echo $form->fileField($model, 'featured_image', array('title' => "Upload " . $model->getAttributeLabel('featured_image'))); ?>
                                <div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize / 1024) / 1024; ?>M </div>
                                <?php echo $form->error($model, 'featured_image'); ?>
                            </div>
                        </div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'position', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->dropDownList($model,'position', $model->positionOption, array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'position'); ?>
                            </div>
			</div>
                        <div class='form-group form-group-sm'>
                            <?php echo $form->labelEx($model,'status', array('class' => 'col-sm-1 control-label')); ?>
                            <div class="col-sm-3">
                                    <?php echo $form->dropDownList($model,'status', $model->optionActive, array('class' => 'form-control')); ?>
                                    <?php echo $form->error($model,'status'); ?>
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