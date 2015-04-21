<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a></li>
    <li>Property Listing</li>
</ul>
    <h3 class="ttl-cnt">Property Listing</h3>
    <ul id="tabs" class="nav nav-tabs tab-listing" data-tabs="tabs">
        <li <?php echo (!isset($_GET['position']) || $_GET['position'] == 'north') ? 'class="active"' : ''; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('site/propertyListing', array('position' => 'north')); ?>">North</a></li>
        <li <?php echo (isset($_GET['position']) && $_GET['position'] == 'east') ? 'class="active"' : ''; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('site/propertyListing', array('position' => 'east')); ?>">East</a></li>
        <li <?php echo (isset($_GET['position']) && $_GET['position'] == 'south') ? 'class="active"' : ''; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('site/propertyListing', array('position' => 'south')); ?>">South</a></li>
        <li <?php echo (isset($_GET['position']) && $_GET['position'] == 'west') ? 'class="active"' : ''; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('site/propertyListing', array('position' => 'west')); ?>">West</a></li>
    </ul>
    <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="tab1">
            <div class="pro-listitng">
                <?php    
                    $data = $model->getData();
                    if (!empty($data)) {
                        $this->widget('zii.widgets.CListView', array(
                            'id'=>'',
                            'dataProvider' => $model,
                            'itemView'=>'item/listing_item',
                            'itemsCssClass' => false,
                            'summaryText'=> 'Showing {start} - {end} of {count} products',
                            'template' => '<div class="pager-wrap clearfix"><div class="show-page"></div>{pager}</div><div class="clearfix"></div><div class="grid clearfix">{items}</div>',
                            'enablePagination'=>true,
                            'pagerCssClass' => 'pager',
                            'pager'=>array(
                                    'header' => false,
                                    'firstPageLabel' => '<span class="glyphicon glyphicon-fast-backward"></span>',
                                    'prevPageLabel' =>  '<span class="glyphicon glyphicon-chevron-left"></span>',
                                    'nextPageLabel' =>  '<span class="glyphicon glyphicon-chevron-right"></span>',
                                    'lastPageLabel' =>  '<span class="glyphicon glyphicon-fast-forward"></span>',
                                    'maxButtonCount'=> 4,
                                    'firstPageCssClass'=>'hidden',
                                    'lastPageCssClass'=>'hidden',
                                    'htmlOptions' => array('class' => 'pagination clearfix'),
                                    'selectedPageCssClass' => 'active',
                            )
                        ));
                    } else {
                        echo 'No results found.';
                    }
                ?>     
                         
           
            </div>
        </div>				
    </div>
