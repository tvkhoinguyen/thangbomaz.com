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
                        array(
                        //'label'=> 'customLabel',
                        'name' => 'image',
                        'type'=>'raw',
                        'value' => $model->image != '' ?  '<div class="thumbnail col-sm-4">' . CHtml::image(
                                        ImageHelper::getImageUrl($model, 'image', KhungBanner2::SIZE ) ,
                                        '' , array(
                                        'style' => 'width :100%',
                                    )) . '</div>' : ''
                    ),

                // array(
    //                     //'label'=> 'customLabel',
    //                     'name' => 'title',
    //                     'type' => 'html',
    //                 ),
                // array(
    //                     //'label'=> 'customLabel',
    //                     'name' => 'content',
    //                     'type' => 'html',
    //                 ),
                // array(
    //                     //'label'=> 'customLabel',
    //                     'name' => 'created_date',
    //                     'type' => 'date',
    //                 ),

                // array(
    //                     //'label'=> 'customLabel',
    //                     'name' => 'order_display',
    //                     'type' => 'html',
    //                 ),

                // array(
    //                     //'label'=> 'customLabel',
    //                     'name' => 'name_banner',
    //                     'type' => 'html',
    //                 ),

                array(
                        //'label'=> 'customLabel',
                        'name' => 'link',
                        'type' => 'html',
                    ),
        ),
    )); ?>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>    </div>
    </div>
</div>
