<?php
/**
 * Created by PhpStorm.
 * User: Phuong Ho
 * Date: 10/28/14
 * Time: 9:30 AM
 */
?>

<div class="row sub-show">
    <div class="col-xs-6">
        <div class="form-group">
            <label class="col-xs-4 control-label">Title:</label>
            <div class="col-xs-3">
               <?php echo $form->dropDownList($model, 'title', Salutations::model()->getList(), array('class' => 'selectpicker')) ;?>
            </div>
        </div>
        <div class="form-group">            
            <?php echo $form->labelEx($model,'contact_first_name', array('class' => 'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
                <?php echo $form->textField($model, 'contact_first_name', array('class' => 'form-control'))?>
                <?php echo $form->error($model, 'contact_first_name')?>
            </div>
        </div>
        <div class="form-group">            
            <?php echo $form->labelEx($model,'address1', array('class' => 'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
                <?php echo $form->textField($model, 'address1', array('class' => 'form-control'))?>
                <?php echo $form->error($model, 'address1')?>
            </div>
        </div>
        <div class="form-group">            
            <?php echo $form->labelEx($model,'address2', array('class' => 'col-xs-4 control-label')); ?>
            <div class="col-xs-8">
                <?php echo $form->textField($model, 'address2', array('class' => 'form-control'))?>
                <?php echo $form->error($model, 'address2')?>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            <?php echo $form->labelEx($model,'contact_last_name', array('class' => 'col-xs-5 control-label')); ?>
            <div class="col-xs-7">
                <?php echo $form->textField($model,'contact_last_name', array('class' => 'form-control'))?>
                <?php echo $form->error($model, 'contact_last_name')?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'area_code_id', array('class' => 'col-xs-5 control-label')); ?>
            <div class="col-xs-7">
                <?php
                    echo $form->dropDownList($model, 'area_code_id', Countries::getDropdownlistWithTableName(), array('class' => 'ship_fee_tab2 selectpicker'))
                ?>
                <?php echo $form->error($model, 'postal_code')?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'postal_code', array('class' => 'col-xs-5 control-label')); ?>
            <div class="col-xs-7">
                <?php echo $form->textField($model,'postal_code', array('class' => 'form-control'))?>
                <?php echo $form->error($model, 'postal_code')?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'email', array('class' => 'col-xs-5 control-label')); ?>
            <div class="col-xs-7">
                <?php echo $form->textField($model, 'email', array('class' => 'form-control'))?>
                <?php echo $form->error($model, 'email')?>
            </div>
        </div>
    </div>
</div>


