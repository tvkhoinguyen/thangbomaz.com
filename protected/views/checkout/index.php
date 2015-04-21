<?php
/**
 * Created by PhpStorm.
 * User: Huu Thoa
 * Date: 5/12/14
 * Time: 9:07 AM
 */
?>

<div class="main clearfix">
    <div class="breadcrumb"><a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">Home</a> <a href="<?php echo Yii::app()->createAbsoluteUrl('site/myCart'); ?>">My Cart</a><strong>Checkout</strong></div>
    <h1 class="title-2">Checkout</h1> 
    <table class="tb">
        <thead>
            <tr>
                <th>Item</th>
                <th style="width: 100px">Type</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Price</th>
                <th class="text-right">Sub Total</th>                    
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($order->orderDetail as $key=> $item) { ?>
            <tr>
                <td class=""><?php echo $item->name; ?></td>
                <td>
                    <?php
                        if ($item->type == ITEM_TYPE_STATIONERY) {
                            echo 'Stationery';
                        } else {
                            echo 'Print Solution';
                        }
                    ?>
                </td>
                <td class="text-right"><?php echo $item->quantity; ?></td>
                <td class="text-right"><?php echo Yii::app()->format->price($item->price); ?></td>
                <td class="text-right"><?php echo Yii::app()->format->price($item->sub_total); ?></td>
                <td class="text-center w-2"><a class="delete-item-cart" href="<?php echo Yii::app()->createAbsoluteUrl('stationeries/deleteItem', array('id' => $item->id)); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-delete.png" alt="icon delete" /></a></td>
            </tr>    
            <?php } ?>
        </tbody>      
    </table> 
    <div id="ajax_cart_summary">
        <?php $this->renderPartial('_cart_summary', array('order' => $order, 'total' => $total,)) ?>
    </div>    
    
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'checkout-form',
        'htmlOptions'=>array('class'=>'form-horizontal', 'role'=>'form'),
        //'enableAjaxValidation'=>true,
        // 'enableClientValidation'=>true,
        'clientOptions' => array(
            //'validateOnSubmit' => true
        )

    )); ?>
            <fieldset>
            <legend>Billing Information</legend>   
            <?php $this->renderPartial('_billing_address_form', array('form' => $form, 'model' => $billing_model)) ?>
            <?php if(!Yii::app()->user->id) :?>
                <div class="check-wrap-2 clearfix">
                    <input type="checkbox" class="checktype uni-check" id="create-account" name="create_account" value="create_account" />
                    <label for="create-account">Create an account for later use</label>
                </div>
            <?php endif;?>
            <div class="check-wrap-2 clearfix">
                <input type="checkbox" id="ship-address" class="uni-check"  name="new_shipping_address" value="new_shipping_address" <?php echo (isset($_POST['new_shipping_address'])) ? 'checked="checked"' : ''?>/>
                <label for="other-address">Deliver to another address</label>
            </div>
            <div class="check-wrap-2 clearfix">
                <?php echo $form->checkbox($billing_model, 'agreeTermOfUse', array('class' => 'checktype uni-check')); ?>
                <label>I agree and understand the <a href="<?php echo Yii::app()->createAbsoluteUrl('cms/index', array('slug'=>'term-and-condition'))?>" target="_blank">terms and conditions</a>.</label>
                <div><?php echo $form->error($billing_model,'agreeTermOfUse'); ?></div>
            </div> 
            <?php $this->renderPartial('_shipping_address_form', array('form' => $form, 'model' => $shipping_model)); ?>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="check-wrap clearfix method-input">
                                <input type="radio" id="paypal" class="uni-radio" name="SpOrder[method]" value="<?php echo ORDER_ONLINE; ?>" <?php if (isset($_POST['SpOrder']['method']) && $_POST['SpOrder']['method'] == ORDER_ONLINE) echo "checked='checked'"; else echo "checked='checked'"; ?> /><label for="paypal">Paypal</label>
                                <input type="radio" id="offline" class="uni-radio" name="SpOrder[method]" value="<?php echo ORDER_OFFLINE;?>" <?php if (isset($_POST['SpOrder']['method']) && $_POST['SpOrder']['method'] == ORDER_OFFLINE) echo "checked='checked'"; ?> /><label for="offline">Offline</label>
                            </div>
                            <div id="payment1" class="sub-content" style="display: block;">
                                <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/paypal.png" alt="paypal" /> Once checkout, you will be directed to the Paypal website.
                            </div>
                            <div id="payment0" class="sub-content">
                                <input type="text" class="form-control" name="SpOrder[reference_number]" <?php if(isset($_POST['SpOrder']['reference_number'])) echo 'value="'.$_POST['SpOrder']['reference_number'].'"' ?> placeholder="Reference Number" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group output">
                        <div class="col-xs-offset-4 col-xs-8">
                            <button type="submit" class="btn-1 btn-right">Checkout</button>
                        </div>
                    </div> 
                </div>
            </div>
    </fieldset>
    <?php $this->endWidget();?>        
</div>

<script type="text/javascript">
    $(document).ready(function() {
        <?php 
            if (isset($_POST['SpOrder']['method']) && $_POST['SpOrder']['method'] == ORDER_OFFLINE) {
        ?>
            $('#payment0').show();
            $('#payment1').hide();
        <?php
            } else if (isset ($_POST['SpOrder']['method']) && $_POST['SpOrder']['method'] == ORDER_OFFLINE) {
        ?>
            $('#payment0').hide();
            $('#payment1').show();    
        <?php
            }
        ?>
        if($('#ship-address').attr('checked')) {
            $(".sub-show").show();
        }
        $('#ship-address').click(function() {
            if (!this.checked) {
                $('.sub-show').slideUp();
            } else {
                $('.sub-show').slideDown();			
            }
        }); 
    });
    
    $('#SpBillingAddress_collection_method').live('change', function() {
        if($('#ship-address').attr('checked'))
            var country_id = $('#SpShippingAddress_area_code_id').val();
        else 
            var country_id = $('#SpBillingAddress_area_code_id').val();
        if ($(this).val() == <?php echo DELIVERY_COLLECTION; ?>) {
            $.ajax({
               url: '<?php echo Yii::app()->createAbsoluteUrl("checkout/shippingFee"); ?>',
               data:{'country_id' : country_id},
               type: 'POST',
               beforeSend: function() {
                   $.blockUI({ message: null });
               },
               success: function(data) {
                   $.unblockUI();
                   if(data != "") {
                       $('#ajax_cart_summary').html(data);
                   }
               },
               error: function(data) {
                   $.unblockUI();
               }
           });
           return false;
        } else if ($(this).val() == <?php echo SELFT_COLLECTION;?>){
            $.ajax({
               url: '<?php echo Yii::app()->createAbsoluteUrl("checkout/removeFee"); ?>',
               data:{'country_id' : country_id},
               type: 'POST',
               beforeSend: function() {
                   $.blockUI({ message: null });
               },
               success: function(data) {
                   $.unblockUI();
                   if(data != "") {
                       $('#ajax_cart_summary').html(data);
                   }
               },
               error: function(data) {
                   $.unblockUI();
               }
           });
           return false;
        }
    });
    
    $('.ship_fee_tab1').live('change', function() {
        if ($('#SpBillingAddress_collection_method').val() == <?php echo DELIVERY_COLLECTION; ?>) {
            var country_id = $('#SpBillingAddress_area_code_id').val();
            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl("checkout/shippingFee"); ?>',
                data:{'country_id' : country_id},
                type: 'POST',
                beforeSend: function() {
                    $.blockUI({ message: null });
                },
                success: function(data) {
                    $.unblockUI();
                    if(data != "") {
                        $('#ajax_cart_summary').html(data);
                    }
                },
                error: function(data) {
                    $.unblockUI();
                }
            });
            return false;
        }
    })

    $('.ship_fee_tab2').live('change', function() {
        if ($('#SpBillingAddress_collection_method').val() == <?php echo DELIVERY_COLLECTION; ?>) {
            var country_id = $('#SpShippingAddress_area_code_id').val();
            var refresh = '<?php echo Yii::app()->createAbsoluteUrl("checkout/index"); ?>';
            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl("checkout/shippingFee"); ?>',
                data:{
                    'country_id' : country_id
                },
                type: 'POST',
                beforeSend: function() {
                    $.blockUI({ message: null });
                },
                success: function(data)
                {
                    $.unblockUI();
                    if (data!="") {
                        $('#ajax_cart_summary').html(data);
                    }
                },
                error: function(data)
                {
                    $.unblockUI();
                }
            });
            return false;
        }
    })
</script>