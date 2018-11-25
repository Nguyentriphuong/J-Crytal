$(document).ready(function(){
	$("#submit").click(function(){
		var name = $("#name").val();

		var d_b = $("#d_b").val();
		var sex = $('input[name=sex]:checked').val();
		var true_work = $('input[name=Y_or_N]:checked').val();
		var phone = $("#phone").val();
		var email = $("#email").val();
		var province = $("#province").val();
		var district = $("#district").val();
		var course = $("#course").val();
		var Class = $("#class").val();
		var time_edu = $("#time_edu").val();
		var type = $("#type").val();
		var business = $("#business").val();
		var time_begin = $("#time_begin").val();
		var time_end = $("#time_end").val();
		var pos = $("#pos").val();
		var salary = $("#salary").val();
	// Returns successful data submission message when the entered information is stored in database.
	var dataString = 'id=' + id_active+'&name='+ name + '&d_b=' + d_b + '&phone=' + phone + '&sex=' +sex+ '&email=' + email + '&time_edu=' + time_edu+
						'&province=' + province +  '&district=' + district + '&course=' + course + '&class=' + Class+'&type=' + type
						+ '&business=' +business+ '&true_work='+true_work+'&time_begin=' + time_begin +  
						'&time_end=' + time_end + '&pos=' +pos+ '&salary=' +salary ;
	// alert(dataString);
	var n = 0;
	if(name=='' )
	{
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		// errors('name',);
		// document.getElementById("error-name").innerHTML = 'Bạn nhập thiểu thông tin ở đây';
		document.getElementById("name").focus();
	}
	else if (d_b == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		// errors('d_b','Bạn nhập thiểu thông tin ở đây');
		document.getElementById("d_b").focus();
			}
	else if (email == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		// errors('email','Bạn nhập thiểu thông tin ở đây');
		document.getElementById("email").focus();
	}
	else if (course == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		// errors('course','Bạn nhập thiểu thông tin ở đây');

		document.getElementById("course").focus();
	}
	else if (Class == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		// errors('class','Bạn nhập thiểu thông tin ở đây');

		document.getElementById("class").focus();
	}
	else if (time_edu == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		document.getElementById("time_edu").focus();

		// errors('time_edu','Bạn nhập thiểu thông tin ở đây');
	}
	else if (type == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		// errors('type','Bạn nhập thiểu thông tin ở đây');
		document.getElementById("type").focus();

	}
	else if (business == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		// errors('business','Bạn nhập thiểu thông tin ở đây');
		document.getElementById("business").focus();
	}
	else if (time_begin == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");;
		// errors('time_begin','Bạn nhập thiểu thông tin ở đây');
		document.getElementById("time_begin").focus();
	}
	else if (pos == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		// errors('pos','Bạn nhập thiểu thông tin ở đây');
		document.getElementById("pos").focus();
	}
	else if (salary == '') {
		n = 1;
		alert("Bạn nhập thiểu thông tin ở đây");
		// errors('salary','Bạn nhập thiểu thông tin ở đây');
		document.getElementById("pos").focus();
	}
	else if (!checkEmail(email)) {
		n=1;
		alert("Warning: Nhập email sai mẫu Example@gmail.com");
		document.getElementById("email").focus();
	}
	if(n == 1){

	}
	else
	{
		// AJAX Code To Submit Form.
		$.ajax({
		type: "POST",
		url: "ajaxsubmit.php",
		data: dataString,
		cache: false,
		success: function(result){
			alert(result);
			}
		});
		myWindow = window.open("index.php", "_self");
	}
	return false;
	});
});
//xu ly su kien go Enter
function DoKeyup(e, myself, nextcontrolid) {
	if (window.event) e = window.event; //de chay ca tren IE
	if (e.keyCode == 13) {
		document.getElementById(nextcontrolid).focus();
	}
}
// Chuan ho ten
function ChuanhoaTen(ten) {
		dname = ten.trim();
		ss = dname.split(' ');
		dname = "";
		for (i = 0; i < ss.length; i++)
			if (ss[i].length > 0) {
				if (dname.length > 0) dname = dname + " ";
				dname = dname + ss[i].substring(0, 1).toUpperCase();
				dname = dname + ss[i].substring(1).toLowerCase();
			}
		return dname;
}
// hàm thông báo lỗi
// function errors(id, value) {
// 	var temp = "error-" + id; 
// 	document.getElementById("error-name").innerHTML = value;
// 	// alert(temp + value);
// }
// hàm kiểm tra email
function checkEmail(email) {
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
	if (!filter.test(email)) {
		return false;
	}
	return true;	
			        	        
}