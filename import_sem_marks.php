<?php
set_time_limit(0);

include 'db.php';

if (isset($_POST["clear"]))
{
	$sql = "TRUNCATE table subject";
	$result = mysqli_query($conn, $sql);
}
if (isset($_POST["drop"]))
{
	$sql = "DROP table 2019_3SEM1";
	$result = mysqli_query($conn, $sql);
}
if(isset($_POST["Import"]))
{
	$tb_name="2019_1sem2";

	$filename=$_FILES["file"]["tmp_name"];
	$tmpf = fopen($filename, "r");
	$tmp = fgetcsv($tmpf);
	fclose($tmpf);
	$cols= count($tmp);
	$cols=$cols-3;

	$subjects="";
	for ($i=1;$i<=$cols;$i++) $subjects=$subjects.", s".$i." varchar(7)";
	// echo $subjects;
	
	if ($subjects!="")
	{
		$qry = "CREATE TABLE IF NOT EXISTS `$tb_name` (rollno varchar(15) primary key, sgpa varchar(5), cgpa varchar(5)".$subjects.")";
		$result = mysqli_query($conn, $qry);
		
		if($_FILES["file"]["size"] > 0)
		{
			$file = fopen($filename, "r");
			$subjects="";
			for ($i=1;$i<=$cols;$i++) $subjects=$subjects.", `s".$i."`";

			while (($stu = fgetcsv($file)) !== FALSE)
			{
				$val = implode('", "', $stu);
				$val = preg_replace("/[e\r]/", "", $val);
				// echo $val."<br>";
				$sql = "INSERT INTO `$tb_name`(`rollno`, `sgpa`, `cgpa`".$subjects.") VALUES (".'"'.$val.'"'.")";
				$result = mysqli_query($conn, $sql);
				// echo $sql."<br>";
			}
			fclose($file);
		}
	}

}
header("Location:index.php");

?>		 