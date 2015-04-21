<?php
$this->breadcrumbs = array(
    'Category Configuration Management' => Yii::app()->createAbsoluteUrl('admin/printPrice'),
    'Create ' . $this->singleTitle,
);
?>
<style>
    .multiselect-container.dropdown-menu {width: 100%}
</style>
<h1><?php echo $modelCate->name; ?>: Create <?php echo $this->pluralTitle; ?></h1>
<div class="navbar-right">
    <div class="btn-group btn-group-sm">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/printPrice'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span> Category Configuration Management</a>
    </div>
</div>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
    </div>
    <div class="panel-body">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'unit-cate',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
            ));
            ?>
            <div class="form-group form-group-sm">
                <label for="PrintSizePaper_print_category_id" class="col-sm-1 control-label required">Print Category <span class="required">*</span></label>                
                <div class="col-sm-3">
                    <input type="text" id="PrintSizePaper_print_category_id" name="PrintSizePaper[print_category_id]" disabled="disabled" class="form-control" value="<?php echo $modelCate->name; ?>">                                    
                </div>
            </div>

            <div class='form-group form-group-sm'>
                <label class="col-sm-1 control-label required">
                    Item per Set <span class="required">*</span>
                </label>
                <!-- <div class="col-sm-3"> -->
                <div class="col-sm-3 wrap_multiselect_attribute display_none">
                    <?php
                    echo CHtml::dropDownList('unit[]', array(), CHtml::listData($modelUnit, 'id', 'value'), array('class' => 'multiselect_attribute', 'multiple' => 'multiple'));
                    ?>
                    <div class="errorMessage error_set" style="display: none">Item per Set can not blank.</div> 
                </div>   
                <!-- </div>    -->
            </div> 

            <div class="clr"></div>
            <div class="well">
            <?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '" ></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'button', 'id' => 'btn_submit')); ?> &nbsp;  
            </div>
            
            <div class="panel-heading">
                   <h1 class="panel-title"><?php echo $this->pluralTitle ?></h1>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <span class="glyphicon glyphicon-th-list"></span>
                    Listing
                    </h3>
                </div>
            <div class="panel-body">
                <?php
                $allowAction = in_array("delete", $this->listActionsCanAccess) ? 'CCheckBoxColumn' : '';
                $columnArray = array();
                if (in_array("Delete", $this->listActionsCanAccess)) {
                    $columnArray[] = array(
                        'value' => '$data->id',
                        'class' => "CCheckBoxColumn",
                    );
                }
                $columnArray = array_merge($columnArray, array(
                    array(
                        'header' => 'S/N',
                        'type' => 'raw',
                        'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                        'headerHtmlOptions' => array('width' => '30px', 'style' => 'text-align:center;'),
                        'htmlOptions' => array('style' => 'text-align:center;')
                    ),
                    array(
                        'header' => 'Value',
                        'value' => '$data->unit->value',
                    ),
                    array(
                        'header' => 'Created Date',
                        'type' => 'date',
                        'value' => '$data->unit->created_date',
                        'htmlOptions' => array('style' => 'text-align:center;')
                    ),
                ));
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'printing-side-grid-bulk',
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('enctype' => 'multipart/form-data')));

                $this->renderNotifyMessage();
                $this->renderDeleteAllButton();

                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'printing-side-grid',
                    //KNguyen fix holder.js not load after gridview update
                    //By: add new jquery gridview and content in Folder:  customassets/gridview
                    //And custom update function
                    //'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
                    'dataProvider' => $model->searchInCate($modelCate->id),
                    'pager' => array(
                        'header' => '',
                        'prevPageLabel' => 'Prev',
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        'nextPageLabel' => 'Next',
                    ),
                    'selectableRows' => 2,
                    'columns' => $columnArray,
                ));
                $this->endWidget();
                ?>
            
        <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.multiselect_attribute').multiselect({
            maxHeight: 200,
            buttonWidth: '300px',
            numberDisplayed: 0,
        });   
    });
    $(window).load(function () {
        $('.wrap_multiselect_attribute').show();
    });
    $('#btn_submit').click(function() {
        $('.error_set').hide();
        $('#unit option').each(function() {
            if ($('#unit option').is(':selected')) {
               $('#unit-cate').submit();
           } else {
               $('.error_set').show();
           }
        });
    });
</script>