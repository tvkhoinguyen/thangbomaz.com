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
                        'name' => 'short_content',
                        'type' => 'html',
                    ),
				array(
                        'name' => 'content',
                        'type' => 'html',
                    ),
				array(
                        'name' => 'image',
                        'type'=>'raw',
                        'value' => $model->image != '' ?  '<div class="thumbnail col-sm-3">' . CHtml::image(
                                        Yii::app()->createAbsoluteUrl($model->uploadImageFolder . '/'.$model->id.'/'.$model->image) ,
                                        '' , array(
                                        'style' => 'width :100%',
                                    )) . '</div>' : ''
                    ),

				// 'get_from',
                array(
                        'name' => 'category_parent_id',
                        'type' => 'categoryName',
                        'value'=> $model->category_parent_id,
                    ),

                array(
                        'name' => 'category_sub_id',
                        'type' => 'categoryName',
                        'value'=> $model->category_sub_id,
                    ),
				'order_display',

				'view',
                array(
                        'name' => 'is_home',
                        'type' => 'raw',
                        'value'=> $model->is_home == 1 ? "Yes" : "No",
                    ),

                array(
                        'name' => 'is_default',
                        'type' => 'raw',
                        'value'=> $model->is_default == 1 ? "Yes" : "No",
                    ),
                array(
                        'name' => 'is_hot',
                        'type' => 'raw',
                        'value'=> $model->is_hot == 1 ? "Yes" : "No",
                    ),
                array(
                        'name' => 'is_marquee',
                        'type' => 'raw',
                        'value'=> $model->is_marquee == 1 ? "Yes" : "No",
                    ),
				array(
                        'name' => 'created_date',
                        'type' => 'datetime',
                    ),
				array(
                        'name' => 'updated_date',
                        'type' => 'datetime',
                    ),
        ),
    )); ?>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>    </div>
    </div>
</div>
