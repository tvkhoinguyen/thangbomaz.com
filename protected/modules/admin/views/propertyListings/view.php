<?php
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    'View ' . $this->singleTitle . ' : ' . $title_name,
);

$this->menu = array(
    array('label'=> $this->pluralTitle, 'url'=>array('index'), 'icon' => $this->iconList),  
    array('label'=> 'Update '. $this->singleTitle, 'url'=>array('update', 'id'=>$model->id)),
    array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);   

?>
<h1>View <?php echo $this->singleTitle . ' : ' . $title_name; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> View <?php echo $this->singleTitle?></h3>
    </div>
    <div class="panel-body">
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array( 
        
            'title',
            array(
                'name' => 'description',
                'type' => 'html',
            ),
            'property_price', 
            'price',            
            array(
                'name' => 'property_type_id',
                'value' => MyFunctionCustom::getInfoRecord('PropertyType', $model->property_type_id, 'name')
            ),
            array(
                'name' => 'condition_id',
                'value' => MyFunctionCustom::getInfoRecord('MasterCondition', $model->condition_id, 'name')
            ),
            array(
                'name' => 'developer_id',
                'value' => MyFunctionCustom::getInfoRecord('MasterDeveloper', $model->developer_id, 'name')
            ),
            array(
                'name' => 'tenure_id',
                'value' => MyFunctionCustom::getInfoRecord('MasterTenures', $model->tenure_id, 'name')
            ),
            array(
                'name' => 'floor_area_id',
                'value' => MyFunctionCustom::getInfoRecord('MasterFloorArea', $model->floor_area_id, 'from_to')
            ),
            array(
                'name' => 'lease_term_id',
                'value' => MyFunctionCustom::getInfoRecord('MasterLeaseTerm', $model->lease_term_id, 'name')
            ),
            'contact_name', 
            'contact_number', 
            'cea_reg',
            array(
                    'name' => 'featured_image',
                    'type'=>'raw',
                    'value' => $model->featured_image != '' ? '<div class="thumbnail col-sm-3">' . CHtml::image(
                                                    Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/'.$model->id.'/'.$model->featured_image) ,
                                                    '' , array(
                                                    'style' => 'width :100%',
                                            )) . '</div>' : ''
            ),
        ),
    )); ?>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>    </div>
    </div>
</div>
