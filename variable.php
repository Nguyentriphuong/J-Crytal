<?php  
	

	$tb_sv = mysqli_query($link, "SELECT LEFT(name,LOCATE(' ', name)-1) as first, RIGHT(name,CHAR_LENGTH(name)-LOCATE(' ', name)) as last, 
									class_id, birthday, sex, phone, Email, district_id 
									FROM cuu_sv WHERE student_id='$id_active'");

	$temp = mysqli_fetch_array ($tb_sv);
	$firstname = $temp['first']; //
	$lastname = $temp['last']; //
	$id_class = $temp['class_id'];
	$last_birthday = $temp['birthday'];
	$birthday = date_format(date_create($last_birthday),"d/m/Y");//
	$phone = $temp['phone']; //
	$Email = $temp['Email']; //
	if ($temp['sex']  ==  '1') 	$sex = 'Nam';
	else $sex = 'Nữ';
	//
	$id_district= $temp['district_id'];

	$tb_district = mysqli_query($link, "SELECT * FROM district  WHERE districtid =  '$id_district'");
	$temp = mysqli_fetch_array ($tb_district);
	$district = $temp['name'];//
	$id_province= $temp['provinceid'];

	$tb_province = mysqli_query($link, "SELECT * FROM province WHERE provinceid = '$id_province'");
	$temp = mysqli_fetch_array ($tb_province);
	$province = $temp['name'];//

	$tb_ct = mysqli_query($link, "SELECT * FROM congtac WHERE student_id =  '$id_active'");
	$temp = mysqli_fetch_array ($tb_ct);

	$last_t_begin = $temp['time_begin'];
	$t_begin = date_format(date_create($last_t_begin),"d/m/Y");//
	$last_t_end = $temp['time_end'];
	$t_end = date_format(date_create($last_t_end),"d/m/Y");//
	$position = $temp['position']; //
	$salary = $temp['salary']; //
	$true_work = $temp['true_work'];//
	$id_office= $temp['office_id'];

	$tb_cq = mysqli_query($link, "SELECT * FROM coquan WHERE office_id = '$id_office'");
	$temp = mysqli_fetch_array ($tb_cq);
	$office = $temp['office_name'];//
	$type = $temp['type'];//

	$tb_k = mysqli_query($link, "SELECT * FROM lop WHERE class_id =  '$id_class'");
	$temp = mysqli_fetch_array ($tb_k);
	$class_name = $temp['class_name'];//
	$id_course= $temp['course_id'];

	$tb_l = mysqli_query($link, "SELECT * FROM khoa WHERE course_id = '$id_course'");
	$temp = mysqli_fetch_array ($tb_l);
	$course_name = $temp['course_name'];//
	$time_edu = $temp['Note'];
?>