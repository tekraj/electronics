	<?php 
		// new object postClass to get posts 
		$postClass=new postQueryModel;

	 ?>

	<div class="banner-mat">
		<div class="container">
			<div class="banner">
	
				<!-- Slideshow 4 -->
			<div class="slider">
<!-- 				<ul class="rslides" id="slider1">
				  <li><img src="<?php echo link_url; ?>assests/images/banner.jpg" alt="">
				  </li>
				  <li><img src="<?php echo link_url; ?>assests/images/banner1.jpg" alt="">
				  </li>
				  <li><img src="<?php echo link_url; ?>assests/images/banner.jpg" alt="">
				  </li>
				  <li><img src="<?php echo link_url; ?>assests/images/banner2.jpg" alt="">
				  </li>
				</ul> -->
				<?php 

					$sliderData=$postClass->singlePost(6);
					echo $sliderData->content;

				 ?>


			</div>

				<div class="banner-bottom">
					<div class="banner-matter">
						<!-- <p>Childish Gambino - Camp Now Available for just $9.99</p> 
						<a href="single.html" class="hvr-shutter-in-vertical ">Purchase</a> -->
					</div>
					<!-- <div class="purchase">
						<a href="single.html" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2 ">Purchase</a>
					</div> -->
					<div class="clearfix"></div>
				</div>
			</div>				
			<!-- //slider-->
		</div>
	</div>




		<!---->
		<div class="container">
			<div class="content">


				<div class="content-top">
					<h3 class="future">Latest Products</h3>
					<div class="content-top-in">
					<?php foreach($products as $singleProduct): ?>

						<div class="col-md-3 md-col">

							<div class="col-md">

								<a href="<?php echo link_url.'product/'.$singleProduct->url; ?>">

									<img  src="<?php echo $singleProduct->featured_image; ?>" alt="" />

								</a>	

								<div class="top-content">
									<h5><a href="<?php echo link_url.'product/'.$singleProduct->url; ?>"><?php echo $singleProduct->name; ?></a></h5>
									<div class="white">
										<a href="<?php echo link_url.'product/'.$singleProduct->url; ?>" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2 ">Buy Now</a>
										<p class="dollar"><span class="in-dollar">$</span><span><?php echo $singleProduct->price; ?></span></p>
										<div class="clearfix"></div>
									</div>

								</div>							
							</div>

						</div>

					<?php endforeach; ?>

						<div class="clearfix"></div>
					</div>
					<div class="clear"></div>
					<div class="pull-right">
						<ul class="start" id="pagination">
						
						</ul>
					</div>
					
				</div>
				<br><br>
				<div class="clear"></div>
				<!---->
				<div class="content-middle">
					<h3 class="future">BRANDS</h3>
					<div class="content-middle-in">
						<ul id="flexiselDemo1">
						<?php foreach ($mainBrands as $singleBrand): ?>	

							<?php if(!empty($singleBrand->image)): ?>
								<li><img src="<?php echo $singleBrand->image; ?>"/></li>
							<?php endif; ?>

						<?php endforeach; ?>
							
						
						</ul>


					</div>
				</div>
				<!---->
				<div class="content-bottom">
					<h3 class="future">Featured Products</h3>
					<div class="content-bottom-in">
						<ul id="flexiselDemo2">	
						<?php foreach ($featured_product as $product): ?>	
						<?php if(!empty($product)): ?>	
							<li><div class="col-md men">
									<a href="<?php echo link_url.'product/'.$product->url; ?>" class="compare-in "><img  src="<?php echo $product->featured_image; ?>" alt="" />
									</a>
									<div class="top-content bag">
										<h5><a href="<?php echo link_url.'product/'.$product->url; ?>"><?php echo $product->name; ?></a></h5>
										<div class="white">
											<a href="<?php echo link_url.'product/'.$product->url; ?>" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2">Buy Now</a>
											<p class="dollar"><span class="in-dollar">$</span><span><?php echo $product->price; ?></span></p>
											<div class="clearfix"></div>
										</div>
									</div>							
								</div></li>
								<?php endif; ?>
							<?php endforeach; ?>
						
						</ul>

					</div>
				</div>
			</div>
		</div>
			<div class="clear"></div>
	<div class="footer-top">
		<div class="container">
		<?php 
			$postPerPage=3;
			$homeContents=$postClass->cmsQuery('home-content',$postPerPage);
		 ?>
		<?php foreach($homeContents as $contents): ?>
			<div class="col-md-4 footer-in">
			<h4><i> </i><?php echo ucfirst($contents->heading); ?></h4>
			<p><?php echo $contents->content; ?></p>
			</div>
		<?php endforeach; ?>

		<div class="clearfix"></div>
		</div>
	</div>
		<!---->


		<script type="text/javascript">


			// script for pagination
			var totalProducts=parseInt('<?php echo $totalProducts; ?>');
			var limit=8;
			var totalPage=totalProducts/limit;
			var currentPage=1;

			if(totalPage > Math.round(totalPage)){
				totalPage= Math.round(totalPage)+1;
			}
			totalPage=Math.round(totalPage);
			var paginationHtml='<li class="prev"><a href="#"><</a></li>';
			for(var i=1;i<=totalPage;i++){
				paginationHtml+='<li class="arrow"><a href="#">'+i+'</a></li>';
			}
			paginationHtml+='<li class="next"><a href="#">></a></li>';
		
			$('#pagination').html(paginationHtml);

			if(totalPage==1){
				$('.prev,.next').addClass('disabled');
			}

			$('.prev a').click(function(e){
				e.preventDefault();
				if($(this).parent().hasClass('disabled'==false)){
					currentPage -=1;
					paginationAjax(currentPage);
				}
			});
			$('.arrow a').click(function(e){
				e.preventDefault();
				var page=parseInt($(this).text());
				currentPage=page;
				paginationAjax(currentPage);
			});
			$('.next a').click(function(e){
				e.preventDefault();
				if($(this).parent().hasClass('disabled')==false){
					currentPage +=1;
					paginationAjax(currentPage);
				}
			});


			function paginationAjax(pageNo){

				var siteUrl='<?php echo link_url;?>';

				if($('#pagination').find('li').hasClass('activePage')){
					$('#pagination').find('li').removeClass('activePage');
				}
				
				$('#pagination').find('li:eq('+pageNo+')').addClass('activePage');

				$.ajax({
					method:'POST',
					url:'<?php echo link_url."site/getProducts" ?>',
					data:{page:currentPage},
					success:function(data){

						var data=JSON.parse(data);
						var productHtml='';
						for( var i=0;i<data.length;i++){
							var product=data[i];

							productHtml+='<div class="col-md-3 md-col">';

							productHtml+='<div class="col-md">';

							productHtml+='<a href="'+siteUrl+'product/'+product.url+'">';

							productHtml+='<img  src="'+product.featured_image+'" alt="" class="img-responsive"/></a>';	

							productHtml+='<div class="top-content">';

							productHtml+='<h5><a href="'+siteUrl+'product/'+product.url+'">'+product.name+'</a></h5>';

							productHtml+='<div class="white">';

							productHtml+='<a href="'+siteUrl+'product/'+product.url+'" class="hvr-shutter-in-vertical hvr-shutter-in-vertical2 ">Buy Now</a>';

							productHtml+='<p class="dollar"><span class="in-dollar">$</span><span>'+product.price+'</span></p>';
							productHtml+='<div class="clearfix"></div></div>';

							productHtml+='</div></div></div>';

							console.log(product.name);
							

						}
						$('.content-top-in').html(productHtml);
					}
				})

			}

			$('.slider').find('ul').addClass('rslides');
			$('.slider').find('ul').attr('id','slider1');

		</script>
		
		