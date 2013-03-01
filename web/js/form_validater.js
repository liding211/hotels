function inputTest(re, str){
	if (str.search(re) != -1)
		return true
	else
		return false
	}

var reg_form = 0;//кол-во проверенных полей	для формы регистрации
		

$('#registration_first_name').blur(
	function(){
	$('.err').remove();
		$("#registration_first_name tr").css("background-color", "#eeeeee");
		if(checkValueLeng(this, "first_name")){
			reg_form++;//добавляем к сумме еще одно проверенное поле
			checkButton('reg', 4);//разблокируем кнопку подтверждения формы
		}
	}
);	

$('#registration_last_name').blur(
	function(){
	$('.err').remove();
		$("#registration_last_name tr").css("background-color", "#eeeeee");
		if(checkValueLeng(this, "last_name")){
			reg_form++;//добавляем к сумме еще одно проверенное поле
			checkButton('reg', 4);//разблокируем кнопку подтверждения формы
		}
	}
);	

$('#registration_email').keyup(
	function(){
	$('.err').remove();
		$("#registration_email tr").css("background-color", "#eeeeee");
		if(checkValueLeng(this, "email", "email")){
			reg_form++;//добавляем к сумме еще одно проверенное поле
			checkButton('reg', 4);//разблокируем кнопку подтверждения формы
		}
	}
);			
		
$('#registration_phone').keyup(
	function(){
		$('.err').remove();
		$("#registration_phone tr").css("background-color", "#eeeeee");
		if(checkValueLeng(this, "phone", "phone")){
			reg_form++;//добавляем к сумме еще одно проверенное поле
			checkButton('reg', 4);//разблокируем кнопку подтверждения формы
		}
	}
);		



$('#signin_email').keyup(
	function(){
		$("tr[id^='reg_err_']").remove();
		$("#signin_email tr").css("background-color", "#eeeeee");
		if(checkValueLeng(this, "client_email", "email")){
			$('#login').removeAttr('disabled');
		}
	}
);	

function checkValueLeng(val, domElem, type){

	$("#reg_err_info_" + domElem).remove();
	
	if (!val.value){
		parent = $('<tr></tr>').attr("id", "reg_err_info_" + domElem).attr("class", "err");
		
		$('<td></td>')
		.attr("colspan", "2")
		.text("*this field is required")
		.appendTo(parent);
		
		$("#" + domElem).css("background-color", "red");
		
		parent.insertAfter("#" + domElem);
		return false;
	}
	
	if (type == 'email'){//проверка поля, помеченного как адрес
		if (!inputTest(/^[a-z0-9]+@[a-z0-9]+\.[a-z0-9]{2,5}$/i, val.value)){
			parent = $('<tr></tr>').attr("id", "reg_err_info_" + domElem).attr("class", "err");
		
			$('<td></td>')
			.attr("colspan", "2")
			.text("*email is incorrect. An example of the correct filling: admin@simple.ru")
			.appendTo(parent);
			
			$("#" + domElem).css("background-color", "red");
			
			parent.insertAfter("#" + domElem);
			return false;
		}
	}
	
	if (type == 'phone'){//проверка поля, помеченного как номер телефона
		//if (!inputTest(/^((38|\+38)[\- ]?)?(\(?\d{4}\)?[\- ]?)?[\d\- ]{6,10}$/, val.value)){
        if (!inputTest(/[0-9 \(\)\-]{6,20}/, val.value)){
			parent = $('<tr></tr>').attr("id", "reg_err_info_" + domElem).attr("class", "err");
		
			$('<td></td>')
			.attr("colspan", "2")
			.text("*phone must contain at least 6 digits. Example: 0512 55-55-55")
			.appendTo(parent);
			
			$("#" + domElem).css("background-color", "red");
			
			parent.insertAfter("#" + domElem);
			return false;
		}
	}
	
	$("#" + domElem).css('background', 'inherit');
	
	return true;
}


function checkButton(name, req_fields){//разблакировка кнопки формы
	if(reg_form == req_fields){//количество полей в форме, обязательных к заполнению
		elem = document.getElementById(name);
		elem.attributes.removeNamedItem('disabled');
	}
}


/*
err = $('.err');
		err.remove();
*/