<!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginStudent"])
	{
		header('location:../login/login.php');
	}
	if($_SESSION['LoginStudent']){
		$_SESSION['LoginAdmin'] = "";
	}
		require_once "../connection/connection.php";
		
	?>
<!---------------- Session Ends form here ------------------------>


<!doctype html>
<html lang="en">
	<head>
    <link rel="shortcut icon" href="$baseUrl/../Images/maharaj.png" type="image/x-icon">
		<title>Student - subject</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/student-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4 class="">Welcome To <?php $roll_no=$_SESSION['LoginStudent'];
					$query="select * from student_info where roll_no='$roll_no'";
					$run=mysqli_query($con,$query);
					while ($row=mysqli_fetch_array($run)) {
						echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
					}
					?>  </h4> </h4>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12">
						<div>
							<section class="mt-3">
								<div class="btn btn-block table-two text-light d-flex">
									<span class="font-weight-bold"><i class="fa fa-file-text-o mr-3" aria-hidden="true"></i>Subjects Detail</span>
									<a href="" class="ml-auto" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus text-light" aria-hidden="true"></i></a>
									
								</div>
								<div class="collapse show mt-2" id="collapseOne">
									<table class="w-100 table-elements table-two-tr"cellpadding="2">
										<tr class="pt-5 table-two text-white" style="height: 32px;">
											<th>Subject Code</th>
											<th>Subject Name</th>
											<th>Semester</th>
											<th>Credit Hours</th>
										</tr>
										<?php $roll_no=$_SESSION['LoginStudent'];
											$max_semester = "select max(semester) as semester from student_courses where roll_no = '$roll_no'";
											$max_run = mysqli_query($con, $max_semester);
											$row = mysqli_fetch_array($max_run);
											$semester = $row['semester'];
											$query="select sc.subject_code,cs.subject_name,sc.semester,cs.credit_hours, sc.roll_no, sc.semester from student_courses sc inner join course_subjects cs on sc.subject_code=cs.subject_code where sc.roll_no='$roll_no' and sc.semester = '$semester'";
											$run=mysqli_query($con,$query);
											while ($row=mysqli_fetch_array($run)) { ?>								
										<tr>
											<td><?php echo $row['subject_code'] ?></td>
											<td><?php echo $row['subject_name'] ?></td>
											<td><?php echo $row['semester'] ?></td>
											<td><?php echo $row['credit_hours'] ?></td>
										</tr>
										<?php } ?>
									</table>
								</div>
							</section>
						</div>
					</div>
			
					<div class="col-lg-6 col-md-12 col-sm-12">
						<div>
							<section class="mt-4">
								<div class="btn btn-block table-five text-light d-flex">
									<span class="font-weight-bold"><i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Current Semester Detail</span>
									<a href="" class="ml-auto" data-toggle="collapse" data-target="#collapsethree"><i class="fa fa-plus text-light" aria-hidden="true"></i></a>
									
								</div>
								<div class="collapse show mt-2" id="collapsethree">
									<table class="w-100 table-elements table-five-tr"cellpadding="2">
										<tr class="pt-5 table-five text-white" style="height: 32px;">
											<th>Subject code</th>
											<th>Subject Name</th>
											<th>Semester</th>
											<th>Marks</th>
										</tr>
										<?php 
											$roll_no=$_SESSION['LoginStudent'];
											$max_semester = "select max(semester) as semester from student_courses where roll_no = '$roll_no'";
											$max_run = mysqli_query($con, $max_semester);
											$row = mysqli_fetch_array($max_run);
											$semester = $row['semester'];
											$query="select * from student_courses inner join course_subjects on student_courses.subject_code=course_subjects.subject_code where student_courses.roll_no='$roll_no' and student_courses.semester = '$semester'";
											$run=mysqli_query($con,$query);
											while ($row=mysqli_fetch_array($run)) { ?>								
											<tr>
												<td><?php echo $row['subject_code'] ?></td>
												<td><?php echo $row['subject_name'] ?></td>
												<td><?php echo $row['semester'] ?></td>
												<td>100</td>
											</tr>
											<?php } 
										?>
									</table>
								</div>
							</section>
						</div>
					</div>
					
				</div>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>