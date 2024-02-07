<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginAdmin"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
		$_SESSION["LoginStudent"]="";
	?>
<!---------------- Session Ends form here ------------------------>


<!--*********************** PHP code starts from here for data insertion into database ******************************* -->
<?php  
 	if (isset($_POST['btn_save'])) {

		$roll_no= $_POST["roll_no"];

 		$first_name=$_POST["first_name"];

 		$middle_name=$_POST["middle_name"];
 		
 		$last_name=$_POST["last_name"];
 		
 		$father_name=$_POST["father_name"];
 		
 		$email=$_POST["email"];
 		
 		$mobile_no=$_POST["mobile_no"];

 		$course_code=$_POST['course_code'];

 		$session=$_POST['session'];
 		
 		$prospectus_issued=$_POST["prospectus_issued"];
 		
 		$prospectus_amount=$_POST["prospectus_amount"];
 		
 		$form_b=$_POST["form_b"];
 		
 		$applicant_status=$_POST["applicant_status"];
 		
 		$application_status=$_POST["application_status"];
 		
 		$cnic=$_POST["cnic"];
 		
 		$dob=$_POST["dob"];
 		 		
 		$gender=$_POST["gender"];
 		
		$permanent_address=$_POST["permanent_address"];
 		
 		$current_address=$_POST["current_address"];
 		
 		$place_of_birth=$_POST["place_of_birth"];
 		
 		$matric_complition_date=$_POST["matric_complition_date"];
 		
 		$matric_awarded_date=$_POST["matric_awarded_date"];
 		
 		$fa_complition_date=$_POST["fa_complition_date"];
 		
 		$fa_awarded_date=$_POST["fa_awarded_date"];
 		
 		$ba_complition_date=$_POST["ba_complition_date"];
 		
 		$ba_awarded_date=$_POST["ba_awarded_date"];

 		$password=$_POST['password'];

 		$role=$_POST['role'];

 		

// *****************************************Images upload code starts here********************************************************** 
		$profile_image = $_FILES['profile_image']['name'];$tmp_name=$_FILES['profile_image']['tmp_name'];$path = "images/".$profile_image;move_uploaded_file($tmp_name, $path);

		$matric_certificate = $_FILES['matric_certificate']['name'];$tmp_name=$_FILES['matric_certificate']['tmp_name'];$path = "images/".$matric_certificate;move_uploaded_file($tmp_name, $path);

		$fa_certificate = $_FILES['fa_certificate']['name'];$tmp_name=$_FILES['fa_certificate']['tmp_name'];$path = "images/".$fa_certificate;move_uploaded_file($tmp_name, $path);

		$ba_certificate = $_FILES['ba_certificate']['name'];$tmp_name=$_FILES['ba_certificate']['tmp_name'];$path = "images/".$ba_certificate;move_uploaded_file($tmp_name, $path);


// *****************************************Images upload code end here********************************************************** 

 		$query="Insert into student_info(roll_no,first_name,middle_name,last_name,father_name,email,mobile_no,course_code,session,profile_image,prospectus_issued,prospectus_amount,form_b,applicant_status,application_status,cnic,dob,gender,permanent_address,current_address,place_of_birth,matric_complition_date,matric_awarded_date,matric_certificate,fa_complition_date,fa_awarded_date,fa_certificate,ba_complition_date,ba_awarded_date,ba_certificate)values('$roll_no','$first_name','$middle_name','$last_name','$father_name','$email','$mobile_no','$course_code','$session','$profile_image','$prospectus_issued','$prospectus_amount','$form_b','$applicant_status','$application_status','$cnic','$dob','$gender','$permanent_address','$current_address','$place_of_birth','$matric_complition_date','$matric_awarded_date','$matric_certificate','$fa_complition_date','$fa_awarded_date','$fa_certificate','$ba_complition_date','$ba_awarded_date','$ba_certificate')";
 		$run=mysqli_query($con, $query);
 		if ($run) {
 			echo "Your Data has been submitted";
 		}
 		else {
 			echo "Your Data has not been submitted";
 		}
 		$query2="insert into login(user_id,Password,Role)values('$roll_no','$password','$role')";
 		$run2=mysqli_query($con, $query2);
 		if ($run2) {
 			echo "Your Data has been submitted into login";
 		}
 		else {
 			echo "Your Data has not been submitted into login";
 		}
 	}
?>


<?php  
	if (isset($_POST['btn_save2'])) {
		$course_code=$_POST['course_code'];

		$semester=$_POST['semester'];

		$roll_no=$_POST['roll_no'];

		$subject_code=$_POST['subject_code'];

		$date=date("d-m-y");

		$query3="insert into student_courses(course_code,semester,roll_no,subject_code,assign_date)values('$course_code','$semester','$roll_no','$subject_code','$date')";
		$run3=mysqli_query($con,$query3);
		if ($run3) {
 			echo "Your Data has been submitted";
 		}
 		else {
 			echo "Your Data has not been submitted";
 		}


	}
?>
<!--*********************** PHP code end from here for data insertion into database ******************************* -->
 
<!doctype html>
<html lang="en">
	<head>
		<title>Admin - Register Student</title>
	</head>
	<body>
    <?php include('../common/common-header.php') ?>
    <?php include('../common/admin-sidebar.php') ?>        
		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<div class="d-flex">
						<h4 class="mr-5">Addmision Management System </h4>
						
					</div>
				</div>
				
  				    <!-- Large modal -->
				
							    
							    <div class="modal-body">
							        <form action="student.php" method="POST" enctype="multipart/form-data">
							
						        </div>
						 

							<table class="w-100 table-elements mb-5 table-three-tr text-center" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th>Roll.No</th>
									<th>Student Name</th>
									<th>Current Address</th>
									<th>Session</th>
									<th>Course ID</th>
									<th>Admission</th>
									<th>Profile</th>
									<th colspan="1">Operations</th>
								</tr>
								<?php 
								$query="select first_name,middle_name,admission_date,last_name,current_address,session,roll_no,form_b ,profile_image,course_code from student_info";
								$run=mysqli_query($con,$query);
								while($row=mysqli_fetch_array($run)) {?>
									<tr>
										<td><?php echo $row["roll_no"] ?></td>
										<td><?php echo $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"] ?></td>
										<td><?php echo $row["current_address"] ?></td>
										<td><?php echo $row["session"] ?></td>
										<td><?php echo $row["course_code"] ?></td>
										<!-- date_format($date,"Y/m/d H:i:s"); -->
										<td><?php echo date("Y-M-d",strtotime($row["admission_date"])); ?></td>
										<td><?php  $profile_image= $row["profile_image"] ?>
										<img height='50px' width='50px' src=<?php echo "images/$profile_image"  ?> >
										</td>
										<td width='170'> 
											<?php 
												echo "<a class='btn btn-primary' href=display-student.php?roll_no=".$row['roll_no'].">Profile</a> 
												<a class='btn btn-danger' href=delete-function.php?roll_no=".$row['roll_no'].">Delete</a> "
											?>
										</td>
									</tr>
								<?php }
								?>
							</table>				
						</section>
					</div>
				</div>	 
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>