<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>card</title>
	<link rel="stylesheet" href="css/card.css">
	<script src="js/jquery-1.12.4.js"></script>
</head>
<body>
	<?php  
	include("connect.php");
	$account = mysqli_query($link, "SELECT * FROM account WHERE active=1");
	$temp = mysqli_fetch_array ($account);
	$id_active = $temp['student_id'];
	include("variable.php");
	?>
	<div class="card">
		<div class="card-header">
			<!-- <img src="img/user.jpg" alt=""> -->
			<div class="cover" style="background-image: url(img/user.jpg);"></div>
			
			<div class="menu">
				<label for="file"> </label><i class="fa fa-pencil-square-o" aria-hidden="true" id="file"></i>
			</div>
			<div class="name">
				<span class="first"><?php echo "$firstname"; ?></span>
				<span class="last"> <?php echo "$lastname"; ?> </span>
			</div>
		</div>
		<div class="container">
			<table style="width:100%" >
				<tr>
					<th>Thông tin liên hệ</th>
				</tr>
				<tr>
					<td>Ngày sinh: <span id="ns"><?php echo "$birthday"; ?></span></td>
				</tr>
				<tr>
					<td>Giới tính: <span id="gt"><?php echo "$sex"; ?></span></td>
				</tr>
				<tr>
					<td>Số điện thoại: <span id="sdt"><?php echo "$phone"; ?></span></td>
				</tr>
				<tr>
					<td>Email: <span id="email"><?php echo "$Email"; ?></span></td>
				</tr>
				<tr class="bott">
					<td>Địa chỉ: <span id="dc"><?php echo "$district, $province"; ?></span></td>
				</tr>
			</table>
			<table style="width:100%" >
				<tr>
					<th>Thông tin khóa học</th>
				</tr>
				<tr>
					<td>Khóa học: <span id="kh"><?php echo "$course_name"; ?></span></td>
				</tr>
				<tr>
					<td>Lớp: <span id="lop"><?php echo "$class_name"; ?></span></td>
				</tr>
				<tr class="bott">
					<td>Thời gian đào tạo: <span id="tgdt"><?php echo "$time_edu"; ?></span></td>
				</tr>
			</table>
			<table style="width:100%" >
				<tr>
					<th>Quá trình công tác</th>
				</tr>
				<tr>
					<td>Nơi làm việc: <span id="nlv"><?php echo "$office" ?></span></td>
				</tr>
				<tr>
					<td>Thời gian: <span id="begin"><?php echo "$t_begin"; ?></span> --- <span id="end"><?php echo "$t_end"; ?></span></td>
				</tr>
				<tr>
					<td>Chức vụ, vị trí: <span id="vc"><?php echo "$position"; ?></span></td>
				</tr>
				<tr class="bott">
					<td>Mức lương: <span id="ml"><?php echo "$salary"; ?></span></td>
				</tr>
			</table>
			
		</div>

	</div>
	<script>
		$(document).ready(function() {
			$("i#file").click(function(event) {
				/* Act on the event */

				myWindow = window.open("form.php", "_self");
			});
		});
	</script>
</body>
</html>