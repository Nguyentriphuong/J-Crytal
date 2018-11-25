<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="css/login.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div class="login-box">
		<!-- <form action="" method="POST"> -->
			<h1>Register Here</h1>
			<div class="textbox">
				<i class="fa fa-user" aria-hidden = "true"></i>
				<input type="text" placeholder="Username or Email" name= "name" id="user" onkeyup="javascript:DoKeyup(event, this, 'password');" >
			</div>
			<div class="textbox" >
				<i class="fa fa-lock" aria-hidden = "true"></i>
				<input type="password" placeholder="Password" name= "password" id="password" onkeyup="javascript:DoKeyup(event, this, 'repassword');" >
			</div>
			<div class="textbox" >
				<i class="fa fa-repeat" aria-hidden="true" id="re_p"></i>
				<input type="password" placeholder="Re-enter Password" name= "repassword" id="repassword" onkeyup="javascript:DoKeyup(event, this, 'active');" >
			</div>
			<div class="textbox" >
				<i class="fa fa-ticket" aria-hidden="true"></i>
				<input type="text" placeholder="Active Code" name= "active" id="active" >
			</div>

			<input class="btn" type="button" name="register" id="register" value="Sign in" >
			<span id="w_mk" style="display: none; color: chartreuse;">Lỗi khi nhập lại mật khẩu</span>
			<span id="w_mk2" style="display: none;color: chartreuse;">Mã active của bạn không đúng, không thể tạo tài khoản</span>
		<!-- </form> -->
		
	</div>
	
	<script>
		$(document).ready(function() {
			$('#register').click(function(event) {
				/* Act on the event */
				var user = $("#user").val();
				var password = $("#password").val();
				var repassword = $("#repassword").val();
				var active = $("#active").val();
				// alert("co chay "+ user + password + repassword + active);
				var dataString = 'user=' + user+'&password='+ password;
				if(user == '' || password == '' || repassword == '' ||  active == ''){
					alert("Bạn chưa nhập đủ thông tin!!!");
				} 
				else if (password != repassword) {
					$("#repassword").val("");
					$("#password").val("");
					document.getElementById('w_mk').style.display='';
					document.getElementById('w_mk2').style.display='none';
					document.getElementById('password').focus();

				}
				else if(active != '1abfbae9bb8234df2886c310d070370d'){
					document.getElementById('w_mk').style.display='none';
					document.getElementById('w_mk2').style.display='';
					document.getElementById('active').focus();
				}
				else {
					// AJAX Code To Submit Form.
					$.ajax({
					type: "POST",
					url: "ajaxregister.php",
					data: dataString,
					cache: false,
					success: function(result){
						
						if (result != 'Tài khoản đã tồn tại') {myWindow = window.open("form.php", "_self");} 
						else {alert(result);}
						}
					});
					// 
				}
				return false;
			});
		});

	</script>
	<script src="js/scriptform.js"></script>
</body>
</html>
