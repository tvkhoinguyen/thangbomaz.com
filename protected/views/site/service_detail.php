<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a></li>
    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/services'); ?>">Services </a></li>
    <li><?php echo $model->name; ?></li>
</ul>
<h3 class="ttl-cnt"><?php echo $model->name; ?></h3>
<div class="detail-life">
    <img src="<?php echo ImageHelper::getImageUrl($model, 'featured_image', '640x200');?>" alt="<?php echo $model->name; ?>"/>
    <table>
    <tbody>
        <tr>
              <td colspan="2"><strong>Address:</strong></td>
               <td><strong>Website:</strong>  </td>
        </tr>
        <tr>
              <td style="width: 220px; padding-right: 20px">
              <?php echo $model->address; ?>
            </td>
            <td>
                <p>Tel: <?php echo $model->telephone; ?></p>
            </td>
              <td><p><a href="<?php echo $model->website; ?>" target="new"><?php echo $model->website; ?></a></p></td>
        </tr>
      </tbody>
    </table>
</div>
<div class="document">
  <span class="date">Posted: <?php echo Yii::app()->format->date($model->created_date); ?></span>
  <?php echo $model->content; ?>
</div>
<div class="social">
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54894f6545bd2aa6" async="async"></script>
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="addthis_sharing_toolbox"></div>                          
</div>