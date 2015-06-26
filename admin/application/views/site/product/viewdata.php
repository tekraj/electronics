<h3><?php echo ucfirst($itemdata->name); ?></h3>
<table class="table table-striped" >
	<?php foreach($itemdata as $key=>$value): ?>
			<tr>
				<th><?php echo ucfirst($key); ?></th>
				<?php if($key=='featured_image'): ?>
					<td>
						<div class="col-md-6">
							<img src="<?php echo $value ?>" class="img-responsive">
						</div>
						
					</td>
				<?php else: ?>
					<td><?php echo $value; ?></td>
				<?php endif;?>
			</tr>
	<?php endforeach; ?>
</table>