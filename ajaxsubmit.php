<?php
include("connect.php");
//Fetching Values from URL
$name=$_POST['name'];
$d_b = $_POST['d_b'];
$phone = $_POST['phone'];
$email = $_POST['email'] ;
$province = $_POST['province'];
$district =$_POST['district'];
$course =$_POST['course'] ;
$class = $_POST['class'];
$time_edu =$_POST['time_edu'];
$type = $_POST['type'];
$business = $_POST['business'];
$time_begin = $_POST['time_begin'];
$time_end = $_POST['time_end'];
$pos = $_POST['pos'];
$salary = $_POST['salary'];
$sex = $_POST['sex'];
$true_work = $_POST['true_work'];
$id_active = $_POST['id'];
//Insert query
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
				/*// lấy tên file upload
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
				}*/
				
				// thêm sv 

				$tb_sv = "UPDATE cuu_sv SET name = '$name', class_id = '$id_class', birthday = '$d_b', sex = '$sex', phone = '$phone', Email = '$email' ,district_id = '$district' WHERE cuu_sv.student_id = '$id_active'";
				$query7 = mysqli_query($link,$tb_sv);
echo "Form Submitted Succesfully";
mysqli_close($link); // Connection Closed
?>