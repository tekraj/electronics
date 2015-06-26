
		<div class="container">
			<div class="single">
				<div class="col-md-9 top-in-single">
					<div class="col-md-5 single-top">
						<div id="manimage">
							<img src="<?php echo $productImages[0]->image?>" class="img-responsive">
						</div>	
						<ul id="etalage">
						<?php foreach($productImages as $pImage): ?>
							<?php if($pImage->image !='null'): ?>
							<li>
								<a href="#">
									<img class="etalage_thumb_image img-responsive" src="<?php echo $pImage->image?>" alt="" >
								</a>
							</li>
							<?php endif; ?>
						<?php endforeach; ?>
						</ul>

					</div>	
					<div class="col-md-7 single-top-in">
						<div class="single-para">
							<h4><?php  echo $productDetail->name; ?></h4>
							<div class="para-grid">
								<span  class="add-to">$<?php  echo $productDetail->price; ?></span>
								<a href="#" class="hvr-shutter-in-vertical cart-to" cart_value="<?php echo $productDetail->id; ?>">Add to Cart</a>					
								<div class="clearfix"></div>
							 </div>
							<h5>KEY FEATURES</h5>
							<p><?php echo $productDetail->detail; ?></p>
							
							
						</div>
					</div>
				<div class="clearfix"> </div>
				</div>
				
				<div class="clearfix"> </div>
		</div>
		</div>
		<script type="text/javascript">

			$('#etalage li img').mouseover(function(){
				var imageSrc=$(this).attr('src');
				$('#manimage').find('img').fadeOut(0);
				$('#manimage').find('img').attr('src',imageSrc);
				$('#manimage').find('img').fadeIn(500);

			})

			$('.cart-to').click(function(e){
				e.preventDefault();
				var prodcutId=$(this).attr('cart_value');
				$.ajax({
					method:'POST',
					url:'<?php echo link_url."cart/addtocart"; ?>',
					data:{id:prodcutId},
					success:function(data){
						var data=JSON.parse(data);
						if(data.status==true){
							var cartItem=parseInt($('.cart span').text());
							cartItem +=1;
							$('.cart span').html(cartItem);
						}else{
							alert('Product Already In cart');
						}
						

					}
				})
			});


		</script>