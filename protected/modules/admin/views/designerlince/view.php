<?php
$this->breadcrumbs=array(
    'Interior Designer'=>Yii::app()->createAbsoluteUrl('admin/designer'),
    $this->designerId->interior_name,    
    $this->pluralTitle => Yii::app()->createAbsoluteUrl('admin/designerlince',array('designerId'=> $this->designerId->id)),
    'View ' . $this->singleTitle ,
);


$menus = array(    
    array('label' => $this->pluralTitle, 'url'=>array('index','designerId'=>$this->designerId->id), 'icon' => $this->iconList),
    array('label'=> 'Update '. $this->singleTitle, 'url'=>array('update', 'designerId'=>$this->designerId->id,'id'=>$model->id)),
    array('label' => 'Create ' . $this->singleTitle, 'url' => array('create','designerId'=>$this->designerId->id)),
);

$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>
<h1>View <?php echo $this->singleTitle ; ?></h1>

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
        				array(
                        'name' => 'image',
                        'type'=>'raw',
                        'value' => $model->image != '' ?  CHtml::image(
                                        Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/'.$model->id.'/85x60/'.$model->image) ,
                                        '' , array(
                                        
                                    ))  : ''
                    ),
				array(
                        'name' => 'created_date',
                        'type' => 'date',
                    ),
        ),
    )); ?>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl . '\'')); ?>    </div>
    </div>
</div>
