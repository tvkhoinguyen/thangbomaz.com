<?php
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    'View ' . $this->singleTitle ,
);

$this->menu = array(
    array('label'=> $this->pluralTitle, 'url'=>array('index'), 'icon' => $this->iconList),  
    // array('label'=> 'Update '. $this->singleTitle, 'url'=>array('update', 'id'=>$model->id)),
    // array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);   

?>
<h1>View <?php echo $this->singleTitle; ?></h1>

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
        
				'code',
                array(
                        'name' => 'title',
                        'type' => 'raw',
                        'value'=> Salutations::model()->findByPk($model->title)->name
                    ),

				'first_name',

				'last_name',

				'email',

				'phone',

				// 'type_of_solution',Request::$type_of_solution[$data->type_of_solution]
                array(
                        'name' => 'type_of_solution',
                        'type' => 'raw',
                        'value'=> Request::$type_of_solution[$model->type_of_solution],
                    ),
				'category',
				array(
                        'name' => 'print_requirement',
                        'type' => 'html',
                    ),
				array(
                        'name' => 'collect_date',
                        'type' => 'date',
                    ),

				// 'attachment',
                array(
                        'name' => 'attachment',
                        'type' => 'raw',
                        'value'=> !empty($model->attachment) ? '<a href="'. Yii::app()->createAbsoluteUrl("/").'/upload/request/'.$model->id.'/'.$model->attachment.'" >download here</a>' : '',
                    ),
				array(
                        'name' => 'created_date',
                        'type' => 'date',
                    ),
        ),
    )); ?>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>    </div>
    </div>
</div>
