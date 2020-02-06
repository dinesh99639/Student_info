<?php
  // session_start();
  include ("../header.php");
  include ("../db.php");

  // if ($_SESSION['usertype']=="student") $un = $_SESSION['username'];
  if ($_SESSION['usertype']=="faculty") $_SESSION['username']=$_GET['rollno'];
  $un = $_SESSION['username'];
  
  $link = mysqli_connect("localhost", "root", "", "student_info");

  if (!isset($_SESSION['username']))  header("Location: ../index.php");

  function read_maintain()
  {
    $file = "../admin/site_status.json";
    $json = json_decode(file_get_contents($file));
    return $json->val;
  }

  if (read_maintain()==1) 
  {
    header("Location: ../maintainance.php");
  }

      $label=array("1-1","1-2","2-1","2-2","3-1","3-2","4-1","4-2");
    //Get Details
    // $un = $_SESSION['username'];
    $qry = "SELECT * from details where rollno='$un'";
    $res = mysqli_query($link, $qry);
    $det = mysqli_fetch_array($res);
    
    $year = 0;
    $sem  = 0;
    $branch = substr($det['branch'], 7);

        $count=0;

        $year=1;
        $data = array();
        while($year<5)
        {

        $o=2;
        $sem=0;
        while($o--)
        {
            $sem++;

            if ($sem == 1) $acyear = (int)("20".((int)($det['rollno'][1].$det['rollno'][2])+$year-1));  
            if ($sem == 2) $acyear = (int)("20".((int)($det['rollno'][1].$det['rollno'][2])+1+$year-1));  
            $join=(int)("20".((int)($det['rollno'][1].$det['rollno'][2])));
            
            $results = $acyear."_".$year."sem".$sem;

            // echo $results;

            $sql = "SELECT * FROM `$results` where rollno='$un'";
            $result = mysqli_query($link, $sql);
            if ($result)
            {
                $row = mysqli_fetch_array($result);

                // $data[$count] = array("y" => 5, "label" => $label[$count]);
                $data[$count] = array("y" => ($row['sgpa']=="")?4:$row['sgpa'], "label" => $label[$count]);
                // if ($data[$count]['y']=="")
                $count++;
            }
        }
        $year++;
    }


  $qry = "SELECT * from details where rollno='$un'";
  $res = mysqli_query($conn, $qry);
  $row = mysqli_fetch_array($res);

?>


<!DOCTYPE html>
<html>
<head>
	<title> Student Dashboard </title>
<!--   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script> -->

<script src="histogram.js"></script>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
  title: {
    text: "Student Performance"
  },
  axisY: {
    title: "SGPA",
    minimum: 4,
    maximum: 10
  },
  axisX: {
    title: "Semister"
  },
  data: [{
    type: "line",
    dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>
<style type="text/css">
	

.col-sm-2 img {
  margin: 0;
  position: absolute;
  left: 50%;
  top:40%;
  /* -ms-transform: translate(-50%, -50%); */
  transform: translate(-50%, -50%);
}
.form-group
{
	font-family: Arial;
	font-size: 18px;
  margin-top: 13px;
}
/*button*/
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #0099cc;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 5px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
.canvasjs-chart-credit
{
  display: none;
}

</style>

</head>
<body>

<div class="body" style="background-color: #F4F7FC;">
  <div class="container-fluid">
   <div class="row">
    <div class="col-sm-2" style="background-color:#9999ff;margin:20px;border-radius: 10px;height: 200px;"><img src="<?php echo  "uploads/pictures/".$_SESSION['username'].".jpg"; ?>" width="140px" height="140px" style=" border-radius:50%; "  align="center">
      <h5 style="text-align: center;margin-top: 180px;"><?php echo $row['name']; ?></h5>
    </div>
  
  <div class="col-sm-9" style="background-color:#9999ff;margin:20px; padding-top: 15px; border-radius: 10px;height: 200px;" align="center">
    <div class="form-group row">
    <div  class="col-sm-4 form-label">Roll no : </div><?php echo $row['rollno']; ?></div>
    <div class="form-group row">
         <div class="col-sm-4 form-label">Name : </div><?php echo $row['name']; ?></div>
    <div class="form-group row">
         <div class="col-sm-4 form-label">Branch : </div><?php echo $row['branch']; ?></div>
    <div class="form-group row">
        <div class="col-sm-4 form-label">Overall CGPA : </div><?php echo $row['b-tech cgpa']; ?></div>
  </div>


</div>
</div>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm-5">
      .........
      <p style="text-align: center; font-size: 25px;"><u>Performance Graph</u></p>
      <div id="chartContainer" style="height: 370px;"></div>
    </div>
    <div class="col-sm-2"></div>
    <div class="col-sm-5">
      <p style="text-align: center; font-size: 25px;"><u>Attendance Graph</u></p>
      <img src="monday-1.jpg" width="100%">
    </div>
  </div>
</div>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm-5" align="center">
      <button class="button" onclick="document.location.href='details.php'"><span>Details </span></button>
    </div>
    <div class="col-sm-2"></div>
    <div class="col-sm-5" align="center">
      <button class="button" onclick="document.location.href='marks.php'"><span>Marks </span></button>
    </div>
  </div>
</div>
<br>
<br>
</div>



<?php include ("../footer.php"); ?>

</body>
</html>