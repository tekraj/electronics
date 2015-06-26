	<div class="container">
		<div id="error">
			
		</div>
		<div class="account">
			<h2 class="account-in">SIGN UP</h2>
				<form method="post" action="<?php echo link_url; ?>member/memberRegister" name="signupForm">
				<div>
					<span>Full Name*</span>
					<input type="text" name="name" required>
				</div>			
				<div> 	
					<span class="mail">Email*</span>
					<input type="email" name="email" required> 
				</div>
				<div> 	
					<span class="mail">Mobile*</span>
					<input type="number" name="mobile" required> 
				</div>
				<div> 
					<span class="word">Password*</span>
					<input type="password" name="password">
					<div id="popup" style="background:#fff;border-radius:4px;box-shadow:0 0 2px 1px #ccc; padding:10px 20px 10px 40px;width:270px;display:none;margin-top:5px;  margin-left: 115px;">
						<p style="color:green;">Password Must Contain at least</p>
						<br>
						<ul style="color:red;" id="popul">
							<li>One Special Character</li>
							<li>One samll Letter</li>
							<li>One Capital Letter</li>
							<li>One Digit</li>
						</ul>
					</div>
				</div>				
					<input type="submit" value="SIGN UP" name="register" id="register"> 
				</form>
		</div>
	</div>
	
	<script type="text/javascript">
		var form=$('form[name="signupForm"]');
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

			var url=form.attr('action'),
			name=form.find('input[name="name"]').val(),
			email=form.find('input[name="email"]').val(),
			mobile=form.find('input[name="mobile"]').val(),
			password=form.find('input[name="password"]').val();
			var singupObject={name:name,email:email,mobile:mobile,password:password};


			if(validCondition!=false){
				$.ajax({
					method:'POST',
					url:url,
					data:singupObject,
					success:function(data){
						var data=JSON.parse(data);
        				if(data.status==true){
							alert('You are successfully Registered');
							window.location.assign('<?php echo link_url."member/login"; ?>');
						}else if( data.search('Duplicate') > -1){
							
							form.find('input[name="email"]').parent().append('<span>This Email is already Registered</span>')
						}else{
							var errorHtml=$('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Sorry Can nto be registered</div>');
							$('#error').html(errorHtml);
						}
					}
				});
			}

			
		})	

	</script>