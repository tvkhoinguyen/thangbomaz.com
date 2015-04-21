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
				'interior_name',
          
                array(
                    'name'=>'feature_designer',
                    'value'=>(isset($model->optionFeature[$model->feature_designer])) ? $model->optionFeature[$model->feature_designer] : ''
                ),
                'established',
                'address',                      
				'warranty_after_sale_service',
                 array(
                    'name' => 'logo',
                    'type'=>'raw',
                    'value' => $model->logo != '' ? CHtml::image(
                                    Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/'.$model->id.'/120x120/'.$model->logo)) : ''
                ),
                 array(
                    'name' => 'present_image',
                    'type'=>'raw',
                    'value' => $model->present_image != '' ? CHtml::image( Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/'.$model->id.'/205x182/'.$model->present_image))  : ''
                ),                 
				array(
                        'name' => 'description',
                        'type' => 'html',
                    ),
                'status:status',
				array(
                        'name' => 'create_date',
                        'type' => 'date',
                    ),
        ),
    )); ?>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>    </div>
    </div>
</div>
