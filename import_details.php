<?php
set_time_limit(0);

include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Import Details To Mysql Database Using PHP </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySql Database Using php">

		<link rel="stylesheet" type="text/css" href="loading/loading-bar.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">

		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

	</head>
	<body>   



	<!-- Navbar
    ================================================== -->

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container"> 
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#">Import Excel To Mysql Database Using PHP</a>
				
			</div>
		</div>
	</div>

	<div id="wrap">
	<div class="container">
		<div class="row">
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="import_details.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<legend>Import CSV/Excel file</legend>
						<div class="control-group">
							<div class="control-label">
								<label>CSV/Excel File:</label>
							</div>
							<div class="controls">
								<input type="file" name="file" id="file" class="input-large">
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
							<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
							<button type="submit" id="submit" name="clear" class="btn btn-primary button-loading" data-loading-text="Loading...">Clear</button>
							<button type="submit" id="submit" name="drop" class="btn btn-primary button-loading" data-loading-text="Loading...">Drop</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>

		</div>

	</div>

	</div>
	
	<!-- <div class="ldBar label-center" data-preset="circle"
id="progress"></div> --> 
<div style="width: 600px;"> 
	<div class="progress-bar progress-bar-striped"></div> 
</div>


	</body>
</html>
<?php

if(isset($_POST["Import"]))
{

	$filename=$_FILES["file"]["tmp_name"];

	if($_FILES["file"]["size"] > 0)
	{
		$tot=0;
		$file = fopen($filename, "r");
		$stu = fgetcsv($file);

		$tmpf = fopen($filename, "r");
		while (($tmp = fgetcsv($tmpf)) !== FALSE) $tot++;
		$tot--;

		$c=0;

		while (($stu = fgetcsv($file)) !== FALSE)
		{
			$val="";
			$l=sizeof($stu);
			for ($i=0;$i<$l;$i++)
			{
				$stu[$i] = preg_replace("/[']/", "\'", $stu[$i]);
				$stu[$i] = preg_replace('/["]/', '\"', $stu[$i]);
			}
			$val = implode('", "', $stu);

			// echo $val."<br><br>";
			$sql = "INSERT INTO `details` VALUES (\"".$val."\")";
			$result = mysqli_query($conn, $sql);
			$c++;

			?>
			<script>
				var i=<?php echo round(($c/$tot)*100); ?>;
				$(".progress-bar").css("width", i + "%").text(i + " %");
			</script>
			<?php
			ob_flush(); flush(); //usleep(50000);

		}
		fclose($file);
		
	}

}

?>		 