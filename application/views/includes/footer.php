		<div class="footer">
			
			<!---->
			<div class="footer-middle">
				<div class="container">
					<div class="footer-middle-in">
						<h6>About us</h6>
						<p>Bonafire  is dedicated to 100% customer delight ensuring that everything from placing your order to delivering it right to your doorstep is smooth and hassle-free.</p>
					</div>
					<div class="footer-middle-in">
						<h6>Information</h6>
						<ul>
							<li><a href="<?php echo link_url; ?>site/about">About Us</a></li>
							<!-- <li><a href="<?php echo link_url; ?>">Delivery Information</a></li> -->
							<li><a href="<?php echo link_url; ?>site/privacy">Privacy Policy</a></li>
							<li><a href="<?php echo link_url; ?>site/condition">Terms & Conditions</a></li>
						</ul>
					</div>
					<div class="footer-middle-in">
						<h6>Customer Service</h6>
						<ul>
							<li><a href="<?php echo link_url; ?>site/contact">Contact Us</a></li>
							<!-- <li><a href="<?php echo link_url; ?>">Returns</a></li>
							<li><a href="<?php echo link_url; ?>">Site Map</a></li> -->
						</ul>
					</div>
					<div class="footer-middle-in">
						<h6>My Account</h6>
						<ul>
							<li><a href="<?php echo link_url; ?>site/account">My Account</a></li>
							<!-- <li><a href="<?php echo link_url; ?>">Order History</a></li> -->
							<!-- <li><a href="<?php echo link_url; ?>wishlist.html">Wish List</a></li>
							<li><a href="<?php echo link_url; ?>">Newsletter</a></li> -->
						</ul>
					</div>
					<div class="footer-middle-in">
						<h6>Extras</h6>
						<ul>
							<li><a href="<?php echo link_url; ?>">Brands</a></li>
							<!-- <li><a href="<?php echo link_url; ?>">Gift Vouchers</a></li>
							<li><a href="<?php echo link_url; ?>">Affiliates</a></li>
							<li><a href="<?php echo link_url; ?>">Specials</a></li> -->
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<p class="footer-class">Copyright © 2015   <a href="#" target="_blank">Bonafire</a> </p>

		</div>

	<script type="text/javascript">
		$(window).load(function() {
			$('img').addClass('img-responsive');
			$("#flexiselDemo1").flexisel({
				visibleItems: 4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		    
		});
	</script>
	<script type="text/javascript" src="<?php echo link_url; ?>assests/js/jquery.flexisel.js"></script>
		<script type="text/javascript">
		$(window).load(function() {
			$("#flexiselDemo2").flexisel({
				visibleItems: 4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		    
		});

	</script>

	<!-- 

	
		/*
		* Script to update the member's status on server if member is logedin
		*/
	 -->


	 <?php if(isset($_SESSION['member'])): ?>

	 	<div class="col-md-4 chat-panel">
	 		<div class="panel panel-default">
	 			<div class="panel-heading">
	 				We are Online Chat With Us 
	 				<a class="pull-right  close-chat chat-control-button" href="#"></a>
	 			</div>
	 			<div class="panel-body chat-body">

	 				
	 			</div>
	 			<div class="panel-footer">
	 				<form>
	 					<input type="text" id="chatmessage" class="form-control pull-left">&nbsp;&nbsp;&nbsp;
	 					
	 					<button type="submit" class="btn btn-success" id="submit-message">Send</button>
	 				</form>
	 			</div>
	 		</div>
	 		
	 	</div>



	 	<script>

	 	(function checkUserStatus(){
	 		var email='<?php echo $_SESSION["member"]->email; ?>',
	 		id='<?php echo $_SESSION["member"]->id; ?>',
	 		memberData={id:id,email:email},
	 		memberUrl='<?php echo link_url."member/keepalive"; ?>',
	 		messageUrl='<?php echo link_url."member/sendMessage" ?>',
	 		memberId='<?php echo $_SESSION["member"]->id; ?>',
	 		checkMessageUrl='<?php echo link_url."member/checkMessage" ?>',
	 		panel=$('.chat-body');
	 		
	 		$('.chat-control-button').click(function(){
	 			panel.slideToggle(500);
	 			$('.panel-footer').slideToggle(500);
	 			$(this).toggleClass('close-chat')
	 		})

	 		var totalSpan=panel.find('span').length,
	 		spanHeight=panel.find('span').outerHeight(),
	 		totalScroll=(parseInt(spanHeight)+10) * totalSpan;

	 		panel.scrollTop(totalScroll);

	 		// ajaxRequest with interval to verify the users status with server

	 		setInterval(function(){
	 			$.ajax({
	 				method:'POST',
	 				url:memberUrl,
	 				data:memberData,
	 				success:function(data){
	 					
	 				}
	 			});
	 		},3000)


	 	$('#submit-message').click(function(e){
	 		e.preventDefault();

	 		var message=$('#chatmessage').val();
	 		

	 		if(message !=''){

	 			var panelHtml='<span class="send">'+message+'</span>';
	 			panel.append(panelHtml);

	 			var totalSpan=panel.find('span').length,
		 		spanHeight=panel.find('span').outerHeight(),
		 		totalScroll=(parseInt(spanHeight)+10) * totalSpan;

	 		panel.scrollTop(totalScroll);
	 			$('#chatmessage').val('');
	 			$.ajax({
	 				method:'POST',
	 				url:messageUrl,
	 				data:{message:message,memberId:memberId},
	 				success:function(data){
	 					if(data!='false'){
	 						
	 					}
	 				}
	 			});
	 		}

	 	})

	 	// code to get message
	 	setInterval(function(){

	 		$.ajax({
	 			method:'POST',
	 			url:checkMessageUrl,
	 			data:{memberId:memberId},
	 			success:function(data){

	 				if(data!='false'){
	 					var data=JSON.parse(data);
	 					panel.append('<span class="receive">'+data.message+'</span>');

	 					var totalSpan=panel.find('span').length,
				 		spanHeight=panel.find('span').outerHeight(),
				 		totalScroll=(parseInt(spanHeight)+10) * totalSpan;

				 		panel.scrollTop(totalScroll);
	 				}
	 			}
	 		});


	 	},1000);
	 	// get message interval end

	 	})();


	 	// function for chat system

	 	



	 	</script>



	 <?php endif; ?>
	
</body>
</html>