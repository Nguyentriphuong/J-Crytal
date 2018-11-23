<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>form cập nhập tài khoản</title>
	<!-- <script src="js/jquery-1.12.4.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <link href="css/style.css" rel="stylesheet"> -->
	
	<script>
	function changeprovince(str) {
	    if (str == "") {
	        document.getElementById("txtHint").innerHTML = "";
	        return;
	    } else { 
	        if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                document.getElementById("huyen").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","huyen.php?q="+str,true);
	        xmlhttp.send();
	    }
	}
	
	</script>
	<style>
	.erorr{
		color: red;
	}
	input[type=text],input[type=date],input[type = tel], select {
	    width: 100%;
	    padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 4px;
	    box-sizing: border-box;
	}
	div#anh {
	    width: 50%;
	    height: 500px;
	    /*border: 1px red solid;*/
	    float: right;
	    /* top: 100px; */
	    margin-top: 9%;
	}
	div#ttlh {
	    float: left;
	    width: 45%;
	}
	div#ttht {
	    clear: both;
	}
	div#image_user {
	    background: #541a5c;
	    border-radius: 10px;
	    border: 1px gray solid;
	    width: 100%;
	    height: 450px;
	    background-repeat: no-repeat;
	    background-position: center center;
	    background-size: cover;
	    box-shadow: 3px 4px 5px 5px #b2c0a9;
	}
	input[type="submit"] {
	    width: 20%;
	    margin-left: 10px;
	    margin-top: 8px;
	    background-color: #4CAF50;
	    color: white;
	    padding: 14px 20px;
	    border: none;
	    border-radius: 4px;
	    cursor: pointer;
	}
	/* #ttlh input[type=text], #ttlh input[type=date],#ttlh input[type = tel], #ttlh select{
		color :red;
		width: 50%;
	} */

	#form input[type=button] {
	    width: 100%;
	    background-color: #4CAF50;
	    color: white;
	    padding: 14px 20px;
	    margin: 8px 0;
	    border: none;
	    border-radius: 4px;
	    cursor: pointer;
	}
	
	input[type=submit]:hover {
	    background-color: #45a049;
	}
	
	div#form {
	    border-radius: 5px;
	    background-color: #f2f2f2;
	    padding: 20px;
	    width: 80%;
	    margin-left: 100px;
	    padding-left: 50px;
	    padding-right: 50px;
	    box-shadow: 0 3px 3px 3px #9ca6b0;
	}
</style>
</head>
<body>
	<?php 
	include("connect.php");
	$account = mysqli_query($link, "SELECT * FROM account WHERE active=1");
	$temp = mysqli_fetch_array ($account);
	$id_active = $temp['student_id'];
	include("variable.php");
	$Name = $firstname." ".$lastname;
	?>
	<div id="form">
	<!-- <form action="" method="POST" enctype="multipart/form-data"> -->
		<div id="ttlh">
			<h3>Thông tin liên hệ</h3>
			<label for="name">Họ và tên</label>: <br><input type="text" id="name" name="name" placeholder="Nhập họ tên" value= '<?php echo "$Name"; ?>' 
				onkeyup="javascript:DoKeyup(event, this, 'd_b');" onblur="javascript: this.value = ChuanhoaTen(this.value);" >
			<span class="erorr" id="erorr-name" ></span><br>
			<label for="d_b"> Ngày sinh</label>: <br><input type="date" id="d_b" name="d_b" placeholder="Nhập ngày sinh" value= '<?php echo "$last_birthday"; ?>' onkeyup="javascript:DoKeyup(event, this, 'male');"> 
			<span class="erorr"  id="erorr-d_b"></span><br>
			<span> Giới tính: </span>
			<label for="male">Nam</label>: <input type="radio" id="male" name="sex" 
										value="1" <?php if ($sex == 'Nam') {echo "checked";} ?> onkeyup="javascript:DoKeyup(event, this, 'female');">
			<label for="female">Nữ</label>: <input type="radio" id="female" name="sex" 
										value="0" <?php if ($sex == 'Nữ') {echo "checked";} ?> onkeyup="javascript:DoKeyup(event, this, 'phone');"><br>
			<span class="erorr"  id="erorr-sex"></span><br>
			
			<label for="phone">Điện thoại</label>: <br><input type="tel" id="phone" name="phone" placeholder="Số điện thoại" value='<?php echo "$phone"; ?>'
			onkeyup="javascript:DoKeyup(event, this, 'email');"> 
			<span class="erorr"  id="erorr-phone"></span><br>
			<label for="email">Email</label>: <br><input type="text" id="email" name="email" placeholder="Email" value='<?php echo "$Email"; ?>' 
			onkeyup="javascript:DoKeyup(event, this, 'course');"> 
			<span class="erorr"  id="erorr-email"></span><br>
			<span>Địa chỉ</span><br>
			<div id="tinh">
			<label for="province">Tỉnh/Thành Phố</label>: <br>
			<select id="province" name="province" onchange="changeprovince(this.value)">
			    <option value=""></option>

			    <?php 
			    $sql = "SELECT * FROM province " ;
				$rel = mysqli_query($link, $sql);
			    while ($row = mysqli_fetch_array ($rel)):; 
			    ?>
			    <option value="<?php echo $row[0]; ?>" <?php if ($row[1] == $province) {echo 'selected';} ?>  >
			    	<?php echo $row[1]; ?>
			    </option>
				<?php endwhile; ?>
			 </select>
			</div>

			<div id="huyen">
			<label for="district">Huyện/Quận</label>: <br>
			<select id="district" name="district">
			    <option value=""></option>
			    <?php 
			    $sql = "SELECT * FROM district " ;
			    $rel = mysqli_query($link, $sql);
			    while ($row = mysqli_fetch_array ($rel)):; 
			    ?>
			    <option value="<?php echo $row[0]; ?>" <?php if ($row[1] == $district) {echo 'selected';} ?>><?php echo $row[1]; ?></option>
			    <?php
			    	// $district = $row[0];
			    	// echo "$district"; 
					endwhile; 
				?>
			 </select>
			</div>


		</div>
		<div id="anh">
		<div id="image_user" style="background-image: url( <?php echo "$img"; ?>);"></div>
		<br>
		<form action="" method="POST" enctype="multipart/form-data">
			<label for="img">Ảnh</label>: <input type="file" id="img" name="img" value='<?php echo "$img" ?>'>
			<span class="erorr" id="erorr-img"><br></span>
			<input type="submit" name="submit" value="Cập nhập">
		</form>
		</div>
		<div id="ttht">
			<h3>Thông tin học tập</h3>
			<label for="course">Khóa học</label>: <input type="text" id="course" name="course" value='<?php echo "$course_name"; ?>' onkeyup="javascript:DoKeyup(event, this, 'class');"> 
			<span class="erorr"  id="erorr-course"></span><br>
			<label for="class">Lớp học</label>: <input type="text" id="class" name="class" value='<?php echo "$class_name"; ?>' onkeyup="javascript:DoKeyup(event, this, 'time_edu');"> 
			<span class="erorr"  id="erorr-class"></span><br>
			<label for="time_edu">Thời gian đào tạo</label>: <input type="text" id="time_edu" name="time_edu" value='<?php echo "$time_edu"; ?>' onkeyup="javascript:DoKeyup(event, this, 'business');"> <br>	
			<span class="erorr"  id="erorr-time_edu"></span>
		</div>
		
		<div class ="qtct">
			<h3>Quá trình công tác</h3>
			<div id="1">
				<label for="business">Nơi làm viêc</label>: <input type="text" id="business" name="business" value='<?php echo "$office"; ?>'onkeyup="javascript:DoKeyup(event, this, 'yes');"> <br>
				<span class="erorr"  id="erorr-business"></span><br>
				<label for="type">Hình thức:</label>
				
				<select name="type" id="type">
					<option value=""></option>
					<option value="Tư nhân" <?php if ($type == "Tư nhân") {echo 'selected';} ?>>Tư nhân</option>
					<option value="Nhà nước" <?php if ($type == "Nhà nước") {echo 'selected';} ?>>Nhà nước</option>
					<option value="Nước ngoài" <?php if ($type == "Nước ngoài") {echo 'selected';} ?>>Nước ngoài</option>
				</select>
				<span class="erorr"  id="erorr-type"></span><br>
				<span>Công việc theo chuyên ngành: </span>
				<label for="yes">Phải</label>: <input type="radio" id="yes" name="Y_or_N" value="1" <?php if ($true_work == '1') {echo "checked";} ?> 
				onkeyup="javascript:DoKeyup(event, this, 'no');">
				<label for="no">Không phải</label>: <input type="radio" id="no" name="Y_or_N" value="0" <?php if ($true_work == '0') {echo "checked";} ?> onkeyup="javascript:DoKeyup(event, this, 'time_begin');">
				<span class="erorr"  id="erorr-Y_or_N"></span><br>

				<label for="time_begin">Thời gian bắt đầu</label>: <input type="date" id="time_begin" name="time_begin" value='<?php echo "$last_t_begin"; ?>' onkeyup="javascript:DoKeyup(event, this, 'time_end');"> &nbsp 
				<label for="time_end">Thời gian kết thúc</label>: <input type="date" id="time_end" name="time_end" value='<?php echo "$last_t_end"; ?>' onkeyup="javascript:DoKeyup(event, this, 'pos');"> 
				<span class="erorr"  id="erorr-time_begin"></span><br>
				<label for="pos">Chức vụ, vị trí:</label>: <input type="text" id="pos" name="pos" value='<?php echo "$position"; ?>' onkeyup="javascript:DoKeyup(event, this, 'salary');"> 

				<span class="erorr"  id="erorr-pos"></span><br>
				<label for="salary">Lương</label>: <input type="text" id="salary" name="salary" value='<?php echo "$salary"; ?>'> 	
				<span class="erorr"  id="erorr-salary"></span><br><br>
			</div>
		</div>
		
		<input type="button" name="submit" id="submit" value="Update">
	<!-- </form> -->
	</div>
	<?php 
		if (isset($_POST['submit'])) {
			# code...
				// lấy tên file upload
			echo "co chay";
				$image=$_FILES['img']['name'];
				// Nếu nó không rỗng
				if ($image)
				{
					// Lấy tên gốc của file
					// echo "co nha";
					$image=$_FILES['img']['name'];
					echo "$image <br>";
					$filename = stripslashes($_FILES['img']['name']);
					//Lấy phần mở rộng của file
					$extension = getExtension($filename);
					$extension = strtolower($extension);
					// Nếu nó không phải là file hình thì sẽ thông báo lỗi
					if (($extension != "jpg") && ($extension != "jpeg") && ($extension !=
					"png") && ($extension != "gif"))
					{
						// xuất lỗi ra màn hình
						erorr('img','Bạn nhập thiểu thông tin ở đây');
						// echo '<h1>Đây không phải là file hình!</h1>';
						$n=1;
					}
					else
					{
						// đặt tên mới cho file hình up lên
						$image_name=$id_active.'.'.$extension;
						//$image_name = 'tenmoi'.'.'.$extension;
						// gán thêm cho file này đường dẫn
						$newname="images/".$image_name;
						$x = $_FILES['img']['tmp_name'];
						// kiểm tra xem file hình này đã upload lên trước đó chưa
						$copied = move_uploaded_file($_FILES['img']['tmp_name'], $newname);
						if (!$copied)
						{
						// echo '<h1> File hình này đã tồn tại </h1>';
						$n=1;
						}
						else{
							$query7 =  mysqli_query($link, "UPDATE cuu_sv SET img = '$newname' WHERE cuu_sv.student_id = '$id_active' ");
						}
						
					}
				}
		}
		function getExtension($str) {
			$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		}
	 ?>
	<script>var id_active = <?php echo $id_active; ?>; </script>
	<script src="js/scriptform.js"></script>
</body>
</html>