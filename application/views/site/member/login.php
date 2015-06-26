	<div class="container">
		<div id="error">
			
		</div>
		<div class="account">
			<h2 class="account-in">LOGIN</h2>
				<form method="post" action="<?php echo link_url.'member/validateMember'; ?>" name="loginForm">
				<div> 	
					<span class="mail">Email*</span>
					<input type="email" name="email" required> 
				</div>
				<div> 
					<span class="word">Password*</span>
					<input type="password" name="password" required>
				</div>

					<input type="submit" value="Login"> 
				</form>
				<p></p>
				<br>
				<p>
					<a href="<?php echo link_url.'member/forgetpassword'; ?>">Forget Password?</a>
				</p>
				<p></p>
				
		</div>
	</div>

		<script type="text/javascript">
		var form=$('form[name="loginForm"]');
		// ajax for register member
		form.submit(function(e){
			e.preventDefault();

			var validCondition=true;
			
			form.find('input').each(function(){

				if($(this).parent().find('.error')){
					$(this).parent().find('.error').remove();
				}

				var errorHtml='<span class="error">*This Field is Required</span>'
				if($(this).val()==''){
					$(this).parent().append(errorHtml);
					validCondition=false;
				}
			});
			

			if(validCondition!=false){
				var url=form.attr('action');
				loginData={email: form.find('input[name="email"]').val() , password:  form.find('input[name="password"]').val() }
				$.ajax({
					method:'POST',
					url:url,
					data:loginData,
					success:function(data){
						var data=JSON.parse(data);
						if(data.status==true){
							window.location.assign('<?php echo link_url; ?>');
						}else{
							var errorHtml=$('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Invalid Email Or Password</div>');
							$('#error').html(errorHtml);
						}
					}
				});
			}	

			
			
		})	

	</script>

