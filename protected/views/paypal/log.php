<table class="table">
	<tr>
		<th>Payment Date</th>
		<th>Type</th>
		<th>Buyer</th>
		<th>Seller</th>
        <th>Description</th>
        <th>Total Price</th>
		<th>Payment Status</th>
	</tr>
	
	<?php foreach($items as $item): ?>
	<tr>
		<td><?php echo date('Y-m-d H:i:s', strtotime($item->payment_date)) ?></td>
		<td><?php echo $item->txn_type ?></td>
		<td><?php echo $item->payer_email ?></td>
		<td><?php echo $item->business ?></td>
        <td><?php echo $item->item_name1 ?></td>
		<td><?php echo  $item->mc_currency . ' ' . $item->mc_gross ?></td>
		<td><?php echo $item->payment_status ?></td>
	</tr>
	<?php endforeach ?>
</table>