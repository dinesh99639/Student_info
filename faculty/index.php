<?php 

	if (isset($_GET['get']))
	{
		require ("../db.php");

		$year = $_GET['year'];
		$acyear = (int)substr($_GET['acyear'],2,2)-$year+1;
		$branch = $_GET['branch'];

		$qry = "SELECT * from details where SUBSTRING(rollno,2,2)-year_diff='$acyear' and branch like \"%".$branch."%\" ";
		$res = mysqli_query($conn,$qry);
		// echo $qry;	
	}

?>

<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="../includes/bootstrap.min.css">
	<script src="../includes/jquery.min.js"></script>
	<script src="../includes/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

	<style>
		
		
		table,th,td{
			border:2px  solid black;
			border-collapse: collapse;
			border-width:3px;
		}
		th,td{
	           padding: 5px;

		}
		table#t1{
	        box-shadow: 0 15px 25px rgba(0,0,0,0.5);
			width:100%;

		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.main_header').load("../header.php");
		});
	</script>
</head>

<body>
	<?php include ("../header.php"); ?>

	<!-- <div class="main_header"></div> -->
	<h1  align="center">Faculty Dashboard</h1>
	<br><br>
	<div class="container">
		<div class="row">
			<form>
				<div class="col-sm-3">
					<div class="col-sm-9"><font size="4px">ACADEMIC YEAR:</font></div>
					<div class="col-sm-3">
						<input class="date-own" name="acyear" style="" type="text">

						<script type="text/javascript">
						   $('.date-own').datepicker({
						      minViewMode: 2,
						      format: 'yyyy'
						    });
						</script>
					</div>	
				</div>
				<div class="col-sm-1"></div>

				<div class="col-sm-3">
					<div class="col-sm-8"><font size="4px">Year:</font></div>
					<div class="col-sm-4">
					<select name="year">
						<option value="1">1st Year</option>
						<option value="2">2nd Year</option>
						<option value="3">3rd Year</option>
						<option value="4">4th Year</option>
					</select>
					</div>	
				</div>

				<div class="col-sm-3">
					<div class="col-sm-7"><font size="4px">BRANCH:</font></div>
					<div class="col-sm-5">
					<select name="branch">
						<option value="CSE">CSE</option>
						<option value="ECE">ECE</option>
						<option value="EEE">EEE</option>
						<option value="CHEMICAL">CHEMICAL</option>
						<option value="IT">IT</option>
						<option value="CIVIL">CIVIL</option>
						<option value="MECH">MECHANICAL</option>
					</select>
					</div>	
				</div>
				<!-- <div class="col-sm-1"></div> -->
				<div class="col-sm-2"><input type="submit" value="Get" name="get"></div>
			</form> 	
			</div>
		</div>
	</div>
	<br><br>
	<div class="container">
        <table class="table table-striped" id="t1">
        <thead>
        <tr>
        <th>ROLLNO</th>
        <th>NAME</th>
        <!-- <th>SGPA</th> -->
        <th>CGPA</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>
        	<?php if (isset($_GET['get'])) 
        	while($row = mysqli_fetch_assoc($res)) { ?>
        	<tr>
        		<td><?php echo $row['rollno'] ?></td>
        		<td><?php echo $row['name'] ?></td>
        		<td><?php echo $row['b-tech cgpa'] ?></td>
        		<td><button onclick="window.location.href='../student/index.php?rollno=<?php echo $row['rollno']; ?>'">View</button></td>
        	</tr>
        	<?php } ?>
        </tbody>
        
       </table>
    </div>	

</body>