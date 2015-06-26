<h3><?php echo ucfirst($itemdata->firstname); ?></h3>
<table class="table table-striped" >
	<?php foreach($itemdata as $key=>$value): ?>
		<?php if($key !='password'): ?>
			<tr>
				<th><?php echo ucfirst($key); ?></th>
				<td> <?php echo $value ?></td>
			</tr>
		<?php endif; ?>
	<?php endforeach; ?>
</table>