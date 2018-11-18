$(document).ready(function(){
	$("#submit").click(function(){
		alert('da click');
	var name = $("#name").val();
	var email = $("#email").val();
	var d_b= $("d_b").val();
	var phone= $("phone").val();
	var province= $("province").val();
	var district= $("district").val();
	var course = $("course").val();
	var Class= $("class").val();
	var time_edu= $("time_edu").val();
	var type= $("type").val();
	var business= $("business").val();
	var time_begin= $("time_begin").val();
	var time_end= $("time_end").val();
	var pos= $("pos").val();
	var salary= $("salary").val();
	var sex=$('input[name=sex]:checked').val();
	var Y_or_N=$('input[name=Y_or_N]:checked').val();


	// Returns successful data submission message when the entered information is stored in database.
	var dataString = 'name='+ name + '&email='+ email + '&d_b' + d_b + '&phone' + phone + 
						'&province' + province +'&district' +district +'&course' + course + '&Class' + Class +
						'&time_edu' + time_edu + '&type' +type + '&business' + business +
						'&time_begin' + time_begin + '&time_end' +time_end + '&pos' +pos+
						'&salary' +salary+ '&sex' +sex+ '&Y_or_N' +Y_or_N;
	// if(name==''||email==''||password==''||contact=='')
	// {
	// alert("Please Fill All Fields");
	// }
	// else
	// {
	// AJAX Code To Submit Form.
	$.ajax({
	type: "POST",
	url: "ajaxform.php",
	data: dataString,
	cache: false,
	success: function(result){
		alert(result);
		}
	});
	// }
	return false;
	});
});