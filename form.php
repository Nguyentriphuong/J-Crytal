<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>form cập nhập tài khoản</title>
	<script src="js/jquery-1.12.4.js"></script>
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
	function ChuanhoaTen(ten) {
		dname = ten;
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
	
	#form input[type=submit] {
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
	<form action="" method="POST" enctype="multipart/form-data">
		<div id="ttlh">
			<h3>Thông tin liên hệ</h3>
			<label for="name">Họ và tên</label>: <input type="text" id="name" name="name" placeholder="Nhập họ tên" value= '<?php echo "$Name"; ?>' onblur="javascript: this.value = ChuanhoaTen(this.value);"> 
			<span class="erorr" id="erorr-name" ></span><br>
			<label for="d_b"> Ngày sinh</label>: <input type="date" id="d_b" name="d_b" placeholder="Nhập ngày sinh" value= '<?php echo "$last_birthday"; ?>'> 
			<span class="erorr"  id="erorr-d_b"></span><br>
			<span> Giới tính: </span>
			<label for="male">Nam</label>: <input type="radio" id="male" name="sex" value="1" <?php if ($sex == 'Nam') {echo "checked";} ?>>
			<label for="female">Nữ</label>: <input type="radio" id="female" name="sex" value="0" <?php if ($sex == 'Nữ') {echo "checked";} ?> ><br>
			<span class="erorr"  id="erorr-sex"></span><br>
			<label for="img">Ảnh</label>: <input type="file" id="img" name="img" value='<?php echo "$img" ?>'> <br> 
			<span class="erorr" id="erorr-img"></span><br>
			<label for="phone">Điện thoại</label>: <input type="tel" id="phone" name="phone" placeholder="Số điện thoại" value='<?php echo "$phone"; ?>'> 
			<span class="erorr"  id="erorr-phone"></span><br>
			<label for="email">Email</label>: <input type="text" id="email" name="email" placeholder="Email" value='<?php echo "$Email"; ?>'> 
			<span class="erorr"  id="erorr-email"></span><br>
			<span>Địa chỉ</span><br>
			<div id="tinh">
			<label for="province">Tỉnh/Thành Phố</label>: 
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
			<label for="district">Huyện/Quận</label>: 
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
		
		<div id="ttht">
			<h3>Thông tin học tập</h3>
			<label for="course">Khóa học</label>: <input type="text" id="course" name="course" value='<?php echo "$course_name"; ?>'> 
			<span class="erorr"  id="erorr-course"></span><br>
			<label for="class">Lớp học</label>: <input type="text" id="class" name="class" value='<?php echo "$class_name"; ?>'> 
			<span class="erorr"  id="erorr-class"></span><br>
			<label for="time_edu">Thời gian đào tạo</label>: <input type="text" id="time_edu" name="time_edu" value='<?php echo "$time_edu"; ?>'> <br>	
			<span class="erorr"  id="erorr-time_edu"></span>
		</div>
		
		<div class ="qtct">
			<h3>Quá trình công tác</h3>
			<div id="1">
				<label for="business">Nơi làm viêc</label>: <input type="text" id="business" name="business" value='<?php echo "$office"; ?>'> <br>
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
				<label for="yes">Phải</label>: <input type="radio" id="yes" name="Y_or_N" value="1" <?php if ($true_work == '1') {echo "checked";} ?>>
				<label for="no">Không phải</label>: <input type="radio" id="no" name="Y_or_N" value="0" <?php if ($true_work == '0') {echo "checked";} ?> >
				<span class="erorr"  id="erorr-Y_or_N"></span><br>

				<label for="time_begin">Thời gian bắt đầu</label>: <input type="date" id="time_begin" name="time_begin" value='<?php echo "$last_t_begin"; ?>'> &nbsp 
				<label for="time_end">Thời gian kết thúc</label>: <input type="date" id="time_end" name="time_end" value='<?php echo "$last_t_end"; ?>'> 
				<span class="erorr"  id="erorr-time_begin"></span><br>
				<label for="pos">Chức vụ, vị trí:</label>: <input type="text" id="pos" name="pos" value='<?php echo "$position"; ?>'> 

				<span class="erorr"  id="erorr-pos"></span><br>
				<label for="salary">Lương</label>: <input type="text" id="salary" name="salary" value='<?php echo "$salary"; ?>'> 	
				<span class="erorr"  id="erorr-salary"></span><br><br>
			</div>
		</div>
		
		<input type="submit" name="submit" value="Update">
	</form>
	</div>
	<?php 

		
		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$d_b = isset($_POST['d_b']) ? $_POST['d_b'] : '';
		if(isset($_POST["sex"])) { $sex = $_POST["sex"];}
		if(isset($_POST["Y_or_N"])) { $true_work = $_POST["Y_or_N"];}
		$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$province = isset($_POST['province']) ? $_POST['province'] : '';
		$district = isset($_POST['district']) ? $_POST['district'] : '';
		$course = isset($_POST['course']) ? $_POST['course'] : '';
		$class = isset($_POST['class']) ? $_POST['class'] : '';
		$time_edu = isset($_POST['time_edu']) ? $_POST['time_edu'] : '';
		$type = isset($_POST['type']) ? $_POST['type'] : '';
		$business = isset($_POST['business']) ? $_POST['business'] : '';
		$time_begin = isset($_POST['time_begin']) ? $_POST['time_begin'] : '';
		$time_end = isset($_POST['time_end']) ? $_POST['time_end'] : '';
		$pos = isset($_POST['pos']) ? $_POST['pos'] : '';
		$salary = isset($_POST['salary']) ? $_POST['salary'] : '';
		$n = 0;


		if (isset($_POST['submit'])) {
			// echo " chya dong nay $name $d_b $email $course $class $time_edu $type $business $time_begin $time_end $pos $salary";
			
			if ($name == '') {
				$n = 1;
				erorr('name','Bạn nhập thiểu thông tin ở đây');
			}

			if ($d_b == '') {
				$n = 1;
				erorr('d_b','Bạn nhập thiểu thông tin ở đây');
			}
			if ($email == '') {
				$n = 1;
				erorr('email','Bạn nhập thiểu thông tin ở đây');
			}
			if ($course == '') {
				$n = 1;
				erorr('course','Bạn nhập thiểu thông tin ở đây');
			}
			if ($class == '') {
				$n = 1;
				erorr('class','Bạn nhập thiểu thông tin ở đây');
			}
			if ($time_edu == '') {
				$n = 1;
				erorr('time_edu','Bạn nhập thiểu thông tin ở đây');
			}
			if ($type == '') {
				$n = 1;
				erorr('type','Bạn nhập thiểu thông tin ở đây');
			}
			if ($business == '') {
				$n = 1;
				erorr('business','Bạn nhập thiểu thông tin ở đây');
			}
			if ($time_begin == '') {
				$n = 1;
				erorr('time_begin','Bạn nhập thiểu thông tin ở đây');
			}
			if ($pos == '') {
				$n = 1;
				erorr('pos','Bạn nhập thiểu thông tin ở đây');
			}
			if ($salary == '') {
				$n = 1;
				erorr('salary','Bạn nhập thiểu thông tin ở đây');
			}
			if (!emailValid($email)) {
				$n=1;
				erorr('email','Warning: Nhập email sai mẫu Example@gmail.com');

			}
			// echo "<br>$n";
			//
		
				
				$sql1 = " SELECT * FROM  khoa WHERE course_name LIKE '$course'";
				$query1 = mysqli_query($link,$sql1);
				$num_row =  mysqli_num_rows($query1);

				if ($num_row != 0) {
					$sql2 = " SELECT l.*, k.course_name FROM  lop l INNER JOIN khoa k ON l.course_id = k.course_id WHERE l.class_name LIKE '$class' AND k.course_name LIKE '$course'";
					$que2 = mysqli_query($link,$sql2);
					$num_row1 =  mysqli_num_rows($que2);

					if ($num_row1 == 0){
						// Thêm lớp trong niêm khóa có sẵn
						$r1 = mysqli_fetch_array ($query1);
						$stt1 = $r1['course_id'];
						$s2 = "SELECT * FROM lop ORDER BY class_id DESC LIMIT 1";
						$q2 = mysqli_query($link,$s2);
						$r2 = mysqli_fetch_array ($q2);
						$stt2 = $r2['class_id'] + 1;
						$tb_lop = "INSERT INTO lop (class_id, class_name, course_id) VALUES ('$stt2', '$class', '$stt1')";
						$query2 = mysqli_query($link,$tb_lop);
						
					}
				}
				else {
					// thêm niêm khóa
					$s1 = "SELECT * FROM khoa ORDER BY course_id DESC LIMIT 1";
					$q1 = mysqli_query($link,$s1);
					$r1 = mysqli_fetch_array ($q1);
					$stt1 = $r1['course_id'] + 1;
					$tb_khoa = "INSERT INTO khoa (course_id, course_name, Note) VALUES ('$stt1', '$course', '$time_edu')";
					$query1 = mysqli_query($link,$tb_khoa);
					// thêm lớp trong niên khóa mới lập
					$s2 = "SELECT * FROM lop ORDER BY class_id DESC LIMIT 1";
					$q2 = mysqli_query($link,$s2);
					$r2 = mysqli_fetch_array ($q2);
					$stt2 = $r2['class_id'] + 1;
					$tb_lop = "INSERT INTO lop (class_id, class_name, course_id) VALUES ('$stt2', '$class', '$stt1')";
					$query2 = mysqli_query($link,$tb_lop);
				}
				// kiểm tra công ti có tồn tại chưa
				$sql3 = " SELECT * FROM  coquan WHERE office_name LIKE '$business' AND type LIKE '$type'";
	            $query3 = mysqli_query($link,$sql3);
	            $num_row3 =  mysqli_num_rows($query3);
	            if ($num_row3 == 0){
	                // thêm công ti nếu công ti chưa tồn tại
	                $sql3 ="SELECT * FROM  coquan ORDER BY office_id DESC LIMIT 1";
	                $query3 = mysqli_query($link,$sql3);
	                $r3 = mysqli_fetch_array($query3);

	                $stt3 = $r3['office_id'] + 1;
	 
	                $tb_cq = "INSERT INTO coquan (office_id, office_name,type) VALUES ('$stt3', '$business', '$type')";
	                
	                $query3 = mysqli_query($link,$tb_cq);
	                    //
	            }
				

				// lấy id của congti
				$tb_office = "SELECT *  FROM coquan WHERE office_name LIKE '$business' AND type LIKE '$type'";
				$query5 = mysqli_query($link,$tb_office);
				$temp_array =  mysqli_fetch_array($query5);
				$id_congti = $temp_array['office_id'];

				

				// thêm công việc
				$tb_ct_kt = "SELECT * FROM congtac WHERE office_id = '$id_congti' AND student_id = '$id_active'";
				$query4_kt = mysqli_query($link,$tb_ct_kt);
				$num_row_kt =  mysqli_num_rows($query4_kt);
				
				if ($num_row_kt == 0){
					// nếu chưa tồn tại thì thêm
					$sql4 ="SELECT * FROM  congtac ORDER BY congtacid DESC LIMIT 1";
	                $query4_id = mysqli_query($link,$sql4);
	                $r4 = mysqli_fetch_array($query4_id);
	                $congtacid = $r4['congtacid'] +1 ;
					$tb_ct = "INSERT INTO congtac (congtacid,student_id, office_id, time_begin, time_end, position, salary, true_work) VALUES ('$congtacid','$id_active', '$id_congti', '$time_begin', '$time_end', '$pos', '$salary', '$true_work')";
					$query4 = mysqli_query($link,$tb_ct);
				}
				
				else{
					// tồn tại rồi thì update
					
					$tb_ct = "UPDATE congtac SET office_id = '$id_congti', time_begin = '$time_begin', time_end = '$time_end', position = '$pos', salary = '$salary', true_work = '$true_work' WHERE congtac.office_id = '$id_congti')";
					$query4 = mysqli_query($link,$tb_ct);
				}

				// lấy id của district
				
				// Lấy id của class
				$tb_lop = "SELECT l.*, k.course_name FROM  lop l INNER JOIN khoa k ON l.course_id = k.course_id WHERE l.class_name LIKE '$class' AND k.course_name LIKE '$course'";
				$query6 = mysqli_query($link,$tb_lop);
				$temp_array =  mysqli_fetch_array($query6);
				$id_class = $temp_array['class_id'];
				// lấy tên file upload
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
				
				// thêm sv 
				$tb_sv = "UPDATE cuu_sv SET name = '$name', class_id = '$id_class', birthday = '$d_b', sex = '$sex', phone = '$phone', Email = '$email' ,district_id = '$district' WHERE cuu_sv.student_id = '$id_active'";
				$query7 = mysqli_query($link,$tb_sv);
			// echo "<h1> lop $class $course</h1>";	
			if ($n == 0) {
				echo "<script>"; 
				echo 'myWindow = window.open("index.php", "_self");';
				echo "</script>";
			}
			else{
				echo "<script>alert('Bạn nhập thiếu hoặc sai thông tin!');</script>";
			}
			
		}
		// include("images.php");
		function getExtension($str) {
			$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		}
		function emailValid($string) 
	    { 
	        if (preg_match ("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $string)) 
	            return true; 
	    }

		function erorr($id, $value)
		{	
			echo "<script>"; 
			echo 'document.getElementById("erorr-'.$id.'").innerHTML = "'.$value.'";';
			echo "</script>";
		}
		
	?>
</body>
</html>