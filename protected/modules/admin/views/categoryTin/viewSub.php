<?php
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    'View ' . $this->singleTitle . ' : ' . $title_name,
);

$this->menu = array(
    array('label'=> $this->pluralTitle, 'url'=>array('indexSub','p_id'=>$model->parent_id), 'icon' => $this->iconList),  
    array('label'=> 'Update '. $this->singleTitle, 'url'=>array('updateSub', 'id'=>$model->id, 'p_id'=>$model->parent_id)),
    array('label' => 'Create ' . $this->singleTitle, 'url' => array('createSub', 'p_id'=>$model->parent_id)),
    // array('label'=>'Create Parent Category', 'url'=>array('createParent')),
);   

?>
<h1>
    <?php echo CategoryTin::model()->findByPk($p_id)->name; ?>
</h1>

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
    <?php 
    
            $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array( 
                        'name',
                        // 'slug',
                        array(
                                'name' => 'created_date',
                                'type' => 'date',
                            ),
                        'status:status',
                        // array(
                        //         'name' => 'updated_date',
                        //         'type' => 'date',
                        //     ),
                        'order_display',
                        // 'parent_id',
                ),
            ));
     ?>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>    </div>
    </div>
</div>
