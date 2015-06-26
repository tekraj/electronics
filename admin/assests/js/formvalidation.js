	//=============function all validation start===========
	function allValidation(data,urls){


		var url= url ? url: '',
		 formName=data.formName,
		 //variable for password validation
		 passwordValidation=data.passwordValidation,
		 //variable for email validation
		 emailValidation=data.emailValidation,
		 //variable for text field validation
		 textFieldValidation=data.textValidation,
		 //variable for textarea field validation
		 textareaFieldValidation=data.textareaValidation,
		 //variable for radio validation
		 radioValidation=data.radioValidation,
		 //variable fro checkBoxValidation
		 checkBoxValidation=data.checkBoxValidation,
		 //variable for select validation
		 selectValidation=data.selectValidation,
		 //variable for file validation
		 fielValidation=data.fileValitaion,
 		 form=$('form[name='+formName+']'),
 		 emailMatch,
 		 formData={};


		 if(emailValidation==true){
			emailMatch=/^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/;
		};

		var passwordMatch=new RegExp('','g');

		if(passwordValidation.required==true){
			var rule;
			if((passwordValidation.oneUppercase==true) && (passwordValidation.oneDigit==true) && (passwordValidation.oneSpecialCharacter==true)){
				rule='(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{'+passwordValidation.maxLength,passwordValidation.minLength+'}';
			}else{
				rule='[a-zA-Z0-9!@#$%^&*]{'+passwordValidation.maxLength,passwordValidation.minLength+'}';
			}
			passwordMatch=new RegExp(rule,'g');
		}


		var textMatch=new RegExp('','g');


		if(textFieldValidation.required==true){
			var rule;
			if(textFieldValidation.specialCharacter==true){
				rule='[a-zA-Z0-9!@#$%^&*]{'+textFieldValidation.textMinLength,textFieldValidation.textMaxLength+'}';
				textMatch=new RegExp(rule,'g');
			}else{
				rule='[a-zA-Z0-9]{'+textFieldValidation.textMinLength,textFieldValidation.textMaxLength+'}';
			}
			
			var textMatch=new RegExp(rule,'g');
			
		}


		var textareaMatch=new RegExp('','g');
		if(textareaFieldValidation.require==true){
			var rule;
			if(textareaFieldValidation.specialCharacter==true){
				rule='[a-zA-Z0-9!@#$%^&*]{'+textareaFieldValidation.minLength,textareaFieldValidation.maxLength+'}';
			}else{
				rule='[a-zA-Z0-9]{'+textMinLength,textMaxLength+'}';
			}
			var textareaMatch=new RegExp(rule,'g');
		}
		
		form.find('input,textarea').blur(function(){
			fieldValidation($(this));
		});


		//===============================================================
		//function to validate the perticular input fields
		//function fieldValidation start
		function fieldValidation(element){
			var validCondition=true;
			var value=element.val() ,
			type=element.attr('type'),
			name=element.attr('name');		
			if(value=='' && type!='file'){
				element.css({'border':'2px solid red'});
				element.parent().append('<span id="error'+name+'"></span>');
				$('#error'+name+'').html('*This Field is Required');
				validCondition=false;
			}
			if(value!='' && type!='file'){
				if(type=='email'){
					if(!(emailMatch.test(value))){
						element.css({'border':'2px solid red'});
						element.parent().append('<span id="error'+name+'"></span>');
						$('#error'+name+'').html('*Invalid Email');
						validCondition=false;
					}
				}
				if(type=='password'){
					if(!(passwordMatch.test(value))){
						element.css({'border':'2px solid red'});
						element.parent().append('<span id="error'+name+'"></span>');
						$('#error'+name+'').html('*Invalid Password');
						validCondition=false;
					}
				}
				if(type=='text'){
					if(!(textMatch.test(value))){
						element.css({'border':'2px solid red'});
						element.parent().append('<span id="error'+name+'"></span>');
						$('#error'+name+'').html('*Invalid Password');
						validCondition=false;
					}
				}
			}
			if(validCondition==true){
				element.css({'border':'1px solid #ccc'});
				if($('#error'+name+'')){
					$('#error'+name+'').html('');
				}
			}
		}
		//function formValidation starts
		function formValidation(){
			var totalInputs=form.find('input');
			var totalTextarea=form.find('textarea');
			var totalSelect=form.find('select');
			var validCondition=true;
			//validation for input fields
			totalInputs.each(function(){
				var type=$(this).attr('type');
				var name=$(this).attr('name');
				var value=$(this).val();
				if(value=='' && type!='file'){
					$(this).css({'border':'2px solid red'});
					$(this).parent().append('<span id="error'+name+'"></span>');
					$('#error'+name+'').html('*This Field is Required');
					validCondition=false;
				}
				if(value!='' && type!='file'){
					if(type=='email'){
						if(!(emailMatch.test(value))){
							$(this).css({'border':'2px solid red'});
							$(this).parent().append('<span id="error'+name+'"></span>');
							$('#error'+name+'').html('*Invalid Email');
							 validCondition=false;
						}else{
								formData[name]=value;
						}
					}
					if(type=='password'){
						if(!(passwordMatch.test(value))){
							$(this).css({'border':'2px solid red'});
							$(this).parent().append('<span id="error'+name+'"></span>');
							$('#error'+name+'').html('*Invalid Password');
							validCondition=false;
						}else{
								formData[name]=value;
						}
					}
					if(type=='text'){
						if(!(textMatch.test(value))){
							$(this).css({'border':'2px solid red'});
							$(this).parent().append('<span id="error'+name+'"></span>');
							$('#error'+name+'').html('*Invalid Input');
							 validCondition=false;
						}else{
								formData[name]=value;
						}
					}
					if(type=='radio'){
						if(!($('input[name='+name+']:checked').val())){
							$(this).parent().append('<span id="error'+name+'"></span>');
							$('#error'+name+'').html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Please select one');
							 validCondition=false;
						}else{
								formData[name]=value;
						}
					}
					if(type=='checkbox'){
						if(!$('input[name='+name+']').is(':checked')){
							$(this).parent().append('<span id="error'+name+'"></span>');
							$('#error'+name+'').html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Please select one');
							 validCondition=false;
						}else{
								formData[name]=value;
						}
					}

				}
			});//validation loop for input end
			//validation loop for textarea
			totalTextarea.each(function(){
				var name=$(this).attr('name');
				var value=$(this).val();
				if(value==''){
					$(this).css({'border':'2px solid red'});
					$(this).parent().append('<span id="error'+name+'"></span>');
					$('#error'+name+'').html('*This Field is Required');
					validCondition=false;
				}else{
					formData[name]=value;
				}
			});
			//validation loop for textarea
			//validation loop for select
			totalSelect.each(function(){
				var name=$(this).attr('name');
				var value=$(this).val();
				if(isNaN(value)){
					$(this).css({'border':'2px solid red'});
					$(this).parent().parent().append('<span id="error'+name+'"></span>');
					$('#error'+name+'').html('*Please Select');
					validCondition=false;
				}else{
					formData[name]=value;
				}
			}); 
			//validation loop for select 
			if(validCondition==true){
				return true;
			}else{
				return false;
			}
		}
		//function formValidation end
		//function fieldValidation end
			form.submit(function(){
				var result=formValidation();
				//code to upload file
			    //code to upload file end
				if(result==true){
					if(data.ajax==true){
						event.preventDefault();
						// var datas   = $(''+form+'').serialize();
						$.when($.ajax({
							method:'POST',
							url:urls,
							data: new FormData(this),
						      processData: false,
						      contentType: false,
							success:function(message){
								$('#output h1').html(message);
								$('form[name='+formName+']')[0].reset();
							}
						})).done(function(){
							 $('#output').css({'display':'block'});
						});
					}
				}else{
					event.preventDefault();
				}
				
				
			});
		}
		
		//=============function all validation end===========
		var data={
			formName:titleForm,//name of the form
			passwordValidation: {//parameter for password validation
									required:false,//password validation required:ture no:false
									maxLength:30,//max length of password
									minLength:2,//min length of password
									oneUppercase:false,//one uppercase is must:true else false
									oneDigit:false,//one digit is must:true else false
									oneLowercase:false,//one lowercase is must:true else false
									oneSpecialCharacter:false//one special character is must:true else false
								},
			emailValidation:true,//email validation yes:true,no:false
			textValidation: {
								blank:false,//accept balnk:true no false
								regex:true,//validation required on text field:true no:false
								maxLength:30,//max no or character user can enter on text field
								minLength:2,//min no or character user can enter on text field
								specialCharacter:true//allow special:true don't allow:false
							},
			textareaValidation: {
									blank:false,//accept balnk:true no false
									regex:true,//validation required on textarea field:true no:false
									maxLength:300,//max no of character user can enter on textarea
									minLength:2,//min no of character user can enter on textarea
									specialCharacter:true//allow special character:true no:false
								},
			checkboxValidation:true,//validation required on checkbox:true no:false
			radioValidation:true,//validation required on radio:true no:false
			selectValidation:true,//validation required on select:true no:false
			fileValitaion:false,//validation required on fileUpload:true no:false
			ajax:false
	};
	


	