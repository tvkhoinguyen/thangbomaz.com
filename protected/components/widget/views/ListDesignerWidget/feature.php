<?php if(is_array($model) && count($model)>0): ?>
    <?php if(isset($model[0])): 
            $data = $model[0];
            $title      =  StringHelper::createShort(strip_tags(nl2br($data->interior_name)),30);
            $content    =  StringHelper::createShort(strip_tags(nl2br($data->description)), 260);
            $srclogo    = ImageHelper::getImageUrl($data, 'logo', '70x70');
            $srcPresent = ImageHelper::getImageUrl($data, 'present_image', '640x285');
            $link       = Yii::app()->createAbsoluteUrl('site/designerdetail',array('slug'=>$data->slug)) ;
    ?>
        <div class="box1-left">
            <h3 class="ttl-2">Our Featured Designers</h3>
            <div class="m-feature">
            <img src="<?php echo $srcPresent; ?>" alt=""/>
            <div class="info-box1-l">
                <div class="top-box1 clearfix">
                    <a href="<?php echo $link; ?>">
                        <img src="<?php echo $srclogo; ?>" alt=""/> 
                        <h3><?php echo $title; ?></h3>
                    </a>
                </div>
                <div class="des-box1-l">
                    <p><?php echo $content; ?></p>
                </div>
                <p class="v-detail"><a href="<?php echo $link; ?>">VIEW DETAILS</a></p>
            </div>
            </div>
        </div><!--box feature-->
    <?php unset($model[0]); endif;  ?>    

    <?php if(is_array($model)&& count($model)>0):?>
        <div class='box2-left box2-left-home-page box-list-designer clearfix'>
            <ul class="bxslider clearfix">
                <li>
                    <?php
                        foreach($model as $key=> $item){
                            if($key==10 ) echo "</li><li>";
                            Yii::app()->controller->renderPartial('application.components.widget.views.ListDesignerWidget._item',array('data'=>$item));
                        }
                    ?>  
                </li>
            </ul>
        </div>
    <?php endif; ?>
<?php endif; ?>

<style>
   .box2-left{margin-top:35px}
   .box2-left a.bx-prev ,.box2-left a.bx-next{top:-10px;}
</style>