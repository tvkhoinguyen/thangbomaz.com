<?php
/**
 * Created by PhpStorm.
 * User: Phuong Ho
 * Date: 10/28/14
 * Time: 9:41 AM
 */
?>
<table class="tb">
    <tfoot>
        <tr>
            <td class="text-right"><strong>Sub Total:</strong></td>
            <td colspan="3" class="text-right"><strong class="total-price"><?php echo Yii::app()->format->price($order->sub_total); ?></strong></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td class="text-right"><strong>Delivery Fee:</strong></td>
            <td colspan="3" class="text-right"><strong class="total-price"><?php echo Yii::app()->format->price($order->shipping_fee); ?></strong></td>
            <td>&nbsp;</td>
        </tr> 
        <?php
            if (Yii::app()->setting->getItem('enable_gst') == TYPE_YES) {
        ?>
        <tr>
            <td class="text-right"><strong>Total exclusive of GST:</strong></td>
            <td colspan="3" class="text-right"><strong class="total-price"><?php echo Yii::app()->format->price($order->total_exclusive_gst); ?></strong></td>
            <td>&nbsp;</td>
        </tr>    
        <tr>
            <td class="text-right"><strong>GST(<?php echo Yii::app()->setting->getItem('gst'); ?>):</strong></td>
            <td colspan="3" class="text-right"><strong class="total-price"><?php echo Yii::app()->format->price($order->gst); ?></strong></td>
            <td>&nbsp;</td>
        </tr>  
        <?php } ?>
        <tr>
            <td class="text-right"><strong>Total inclusive of GST:</strong></td>
            <td colspan="3" class="text-right"><strong class="total-price"><?php echo Yii::app()->format->price($order->total); ?></strong></td>
            <td>&nbsp;</td>
        </tr>   
    </tfoot>
</table>