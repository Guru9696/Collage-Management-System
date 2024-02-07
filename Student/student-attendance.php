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
	<link rel="shortcut icon" href="./Images/maharaj.png" type="image/x-icon">
		<title>Student - Attendance</title>
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
			
					<div class="col-lg-10 col-md-12 col-sm-12">
						<div>
							<section class="mt-4">
								<div class="btn btn-block table-one text-light d-flex">
									<span class="font-weight-bold"><i class="fa fa-check-square-o mr-3" aria-hidden="true"></i>Attendance Status</span>
									<a href="" class="ml-auto" data-toggle="collapse" data-target="#collapsefour"><i class="fa fa-plus text-light" aria-hidden="true"></i></a>
									
								</div>
								<div class="collapse show mt-2" id="collapsefour">
									<table class="w-100 table-elements table-one-tr"cellpadding="2">
										<tr class="pt-5 table-one text-white" style="height: 32px;">
											<th>Roll No</th>
											<th>Present</th>
											<th>Absent</th>
											<th>Percentage</th>
										</tr>
										<?php 
											$roll_no=$_SESSION['LoginStudent'];
											$query="select count(attendance_id) as attendance_id,sum(attendance) as attendance,student_id from student_attendance where student_id='$roll_no'";
											$run=mysqli_query($con,$query);
											while ($row1=mysqli_fetch_array($run)) { ?>
											<tr>
												<td><?php echo $_SESSION['LoginStudent'] ?></td>
												<td><?php echo $row1['attendance'] ? $row1['attendance'] : "0" ?></td>
												<td><?php echo $row1['attendance_id']-$row1['attendance']?></td>
												<?php $attendace =  $row1['attendance_id'] > 0 ? round(($row1['attendance']*100)/$row1['attendance_id'])."%" : "0%" ?>
												<td> <?php echo $attendace ?> </td>
											</tr>
											<?php	
											}
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