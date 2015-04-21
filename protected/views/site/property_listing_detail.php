
    <ul class="breadcrumb">
        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a></li>
        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/propertyListing'); ?>">Property Listing  </a></li>
        <li><?php echo CHtml::encode($model->title); ?></li>
</ul>
<h3 class="ttl-cnt"><?php echo CHtml::encode($model->title); ?></h3>
<div class="detail-life">
<img src="<?php echo ImageHelper::getImageUrl($model, 'featured_image', '640x350');?>" alt="<?php echo $model->title; ?>"/>

<div class="document pro-detail">
    <h3>Description</h3>
    <p><?php echo $model->description; ?></p>
    <h3>Details</h3>
    <table>
        <tr>
        <td>Property Name:</td>
        <td><strong><?php echo $model->title; ?><br>
        </strong></td>
        </tr>
        <tr>
          <td>Property Type:</td>
          <td><strong><?php echo MyFunctionCustom::getInfoRecord('PropertyType', $model->property_type_id, 'name');?></strong></td>
        </tr>
        <tr>
          <td> Price:</td>
          <td><strong><?php echo Yii::app()->format->price($model->property_price) ;?></strong></td>
        </tr>
        <tr>
          <td>Price (psf): </td>
          <td><strong><?php echo Yii::app()->format->price($model->price) ;?></strong></td>
        </tr>
        <tr>
          <td>Floor Area:</td>
          <td><strong><?php echo MyFunctionCustom::getInfoRecord('MasterFloorArea', $model->floor_area_id, 'from_to');?></strong></td>
        </tr>
        <tr>
          <td> Condition:</td>
          <td><strong><?php echo MyFunctionCustom::getInfoRecord('MasterCondition', $model->condition_id, 'name'); ?></strong></td>
        </tr>
        <tr>
          <td>Developer:</td>
          <td><strong><?php echo MyFunctionCustom::getInfoRecord('MasterDeveloper', $model->developer_id, 'name');?></strong></td>
        </tr>
        <tr>
          <td>Tenure:</td>
          <td><strong><?php echo MyFunctionCustom::getInfoRecord('MasterTenures', $model->tenure_id, 'name'); ?></strong></td>
        </tr>
        <tr>
          <td>Lease Term:</td>
          <td><strong><?php echo MyFunctionCustom::getInfoRecord('MasterLeaseTerm', $model->lease_term_id, 'name'); ?></strong></td>
        </tr>

    </table>
    <h3>Contact Details:</h3>
    <table>
        <tr>
          <td>Name:</td> 
            <td><strong><?php echo $model->contact_name; ?><br>
            </strong></td>
        </tr>
        <tr>
          <td> Number:</td>
          <td><strong><?php echo $model->contact_number; ?></strong></td>
          </tr>
        <tr>
          <td> CEA:</td>
          <td><strong><?php echo $model->cea_reg; ?></strong></td>
          </tr>
    </table>
</div>

</div>