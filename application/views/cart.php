<div class="container main_cont">
	<div class="row">

	<span class="cart-tab">Cart ( <?php echo isset($_SESSION['cartId']) ? count($_SESSION['cartId']) : 0;  ?> )</span>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"></h3>
			</div>
			<div class="panel-body">
				<table class="table table-stripted">
				<?php if(count($cartData)>0): ?>
					<thead>
						<tr>
							<th>ITEM</th>
							<th>QTY</th>
							<th>PRICE</th>
							<th>SUBTOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$totalPrice=0;
							foreach($cartData as $myProduct):
						 ?>
							<tr c_id="<?php echo $myProduct->id; ?>">
								<td><?php echo $myProduct->name; ?></td>
								<td c_id=""><input type="number" value="<?php echo $myProduct->quantity; ?>" class="productQuantity
								"><span><a href="javascript:void(0)" class="saveQuantity">Save</a></span></td>
								<td><?php echo $myProduct->price; ?></td>
								<td class="subprice"><?php echo $myProduct->price * $myProduct->quantity; $totalPrice=($myProduct->price * $myProduct->quantity) + $totalPrice?></td>
							</tr>
						<?php endforeach; ?>
						<tr>
							<th><b>Grand Total</b></th>
							<th></th>
							<th></th>
							<th id="grandTotal"><b><?php echo $totalPrice; ?></b></th>
						</tr>
						<tr>
							<td><a href="<?php echo link_url; ?>" class="btn btn-primary">Continue Shopping</a></td>
							<td><a href="<?php echo link_url ?>order" class="btn btn-success">Place Order</a></td>
						</tr>
					</tbody>
				<?php else: ?>
					<tr>
						<th><b>No Products on Cart</b></th>
							<td><a href="<?php echo link_url; ?>" class="btn btn-primary">Continue Shopping</a></td>
					</tr>
				<?php endif; ?>
				</table>
			</div>
		</div>	
	</div>
</div>
<script>
	$(document).ready(function(){

		$('.productQuantity').next('span').hide();

		$('.productQuantity').change(function(){
			$(this).next('span').show();
			$(this).next('span').find('.saveQuantity').show();

			var price=$(this).parent().next().text();
			var quantity=$(this).val();
			if(quantity <= 0){
				$(this).val(1);
			}
			if(quantity > 10){
				alert("Sorry We do not sell a single product more than 10");
				$(this).val(10);
			}


			quantity=$(this).val();

			var totalPrice=price*quantity;

			$(this).parent().next().next().html(totalPrice);

			var grandPrice=0;

			$('.subprice').each(function(){
				var subprice=$(this).text();
				grandPrice=parseInt(subprice)+parseInt(grandPrice);
			})
			$('#grandTotal').html(grandPrice);

		})

		$('.saveQuantity').click(function(){

			var quan=$(this).parent().prev().val();
			ids=$(this).parent().parent().parent().attr('c_id');
			$.ajax({
				method:'POST',
				url:"<?php echo link_url; ?>cart/addquantity",
				data:{id:ids,quantity:quan},
				success:function(data){
					var data=JSON.parse(data);
        			if(data.status==true){
						$('.saveQuantity').hide();
					}
				}
			})
		})

	});
</script>