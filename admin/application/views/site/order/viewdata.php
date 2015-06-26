<h3></h3>
<table class="table table-striped" >
	<?php foreach($itemdata as $key=>$value): ?>
			<tr>
				<th><?php echo ucfirst($key); ?></th>
				<td><?php echo $value; ?></td>
			</tr>
	<?php endforeach; ?>
</table>