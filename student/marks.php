<?php
    // session_start();
    include ("../header.php");
    
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
    
    $link = mysqli_connect("localhost", "root", "", "student_info");
     
    
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //Get Details
    $un = $_SESSION['username'];
    $qry = "SELECT * from details where rollno='$un'";
    $res = mysqli_query($link, $qry);
    $det = mysqli_fetch_array($res);
    
    $year = 0;
    $sem  = 0;
    $branch = substr($det['branch'], 7);

    if (isset ($_GET['get_results']))
    {
        $year = $_GET['year'];
        $sem = $_GET['semister'];

        if ($sem == 1) $acyear = (int)("20".((int)($det['rollno'][1].$det['rollno'][2])+$year-1));  
        if ($sem == 2) $acyear = (int)("20".((int)($det['rollno'][1].$det['rollno'][2])+1+$year-1));  
        
        $results = $acyear."_".$year."sem".$sem;

        // echo $results;

        $sql = "SELECT * FROM `$results` where rollno='$un'";
        $result = mysqli_query($link, $sql);
        if ($result)
        {
            $row = mysqli_fetch_array($result);
            // $len = mysqli_num_fields($result)-4;

            //Subjects
            
            $qry = "SELECT * from subjects where `academic year`='$acyear' and year='$year' and semester='$sem' and branch='$branch'";
            $res = mysqli_query($link, $qry);
            $subjects_tb = mysqli_fetch_array($res);
            
            $sub = explode (",", $subjects_tb['subjects']); 
            $sub_code = explode (",", $subjects_tb['subject code']); 
            $credits = explode (",", $subjects_tb['credits']); 
            $len = sizeof($credits);

            // $tot_credits=0;
            // for ($i=0;$i<$len; $i++) if($row['s'.(string)($i+1)]!="F") $tot_credits+=$credits[$i];
            $tot_credits = array_sum($credits);
        }
    }    
    
    mysqli_close($link);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Marks</title>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script> -->
    </head>
    <!-- <link rel="stylesheet" type="text/css" media="print" href="print.css"> -->
    <style type="text/css" media="all">
        .card
        {
        border-radius: 20px;
        padding: 20px;
        border: none;
        box-shadow: 0 15px 25px rgba(0,0,0,0.5);
        }
        p {
        font-family: verdana;
        font-size: 14px;
        }
        div {
        font-family: verdana;
        font-size: 14px;
        }
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        th, td {
        padding: 8px;
        text-align: center;
        }
        .select
        {
            border: none;
            outline: none;
            border-bottom: 1px solid;
            border-radius: 15px;
        }
        .select select-items
        {
            border: none;
            outline: none;
            border-bottom: 1px solid black;
            border-radius: 15px;
        }
        .get_results
        {
            border: none;
            outline: none;
            border-radius: 20px;
            background-color: rgba(34, 167, 240, 1);
            height: 35px;
            color: white;
        }
    </style>
    <body>
        <div class="body" style="background-color: #fff;">
            <div class="container">
                <form method="get">
                    <div class="row" style="margin-top: 30px;">
                            <div class="col-sm-5" style="padding: 0;">
                                <div class="row">
                                    <div class="col-sm-4">Year :</div>
                                    <div class="col-sm-8">
                                        <select class="select" name="year">
                                            <option <?php if ($year==1) echo "selected"; ?> value="1">1st year</option>
                                            <option <?php if ($year==2) echo "selected"; ?> value="2">2nd year</option>
                                            <option <?php if ($year==3) echo "selected"; ?> value="3">3rd year</option>
                                            <option <?php if ($year==4) echo "selected"; ?> value="4">4th year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="row">
                                    <div class="col-sm-4">Semister :</div>
                                    <div class="col-sm-8">
                                        <select class="select" name="semister">
                                            <option <?php if ($sem==1) echo "selected"; ?> value="1">1st Semiseter</option>
                                            <option <?php if ($sem==2) echo "selected"; ?> value="2">2nd Semiseter</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" class="get_results" value="Get Results" name="get_results">
                            </div>
                    </div>
                </form>
                <?php 
                if (isset($result)) if ($result) {
                    if ($year==1) $postfix = "st";
                    if ($year==2) $postfix = "nd";
                    if ($year==3) $postfix = "rd";
                    if ($year==4) $postfix = "th";

                    $heading = $year.$postfix." Year ".$sem;

                    if ($sem==1) $postfix = "st";
                    if ($sem==2) $postfix = "nd";
                    if ($sem==3) $postfix = "rd";
                    if ($sem==4) $postfix = "th";

                    $heading .=$postfix." Semister Results (".$acyear.")";
                ?>
                <p style="text-align: center; margin-top: 30px;"><?php echo $heading; ?></p>
            <?php } ?>
            </div>
            <?php 
            if (isset($result)) if ($result) {
            ?>
            <div class="container">
                <div class="row card" style="margin: 30px 0 50px 0">
                    <div style="margin-left: 20px;">
                        <p>Student : <?php echo $det['name']; ?></p>
                        <p>Course : B-Tech</p>
                        <p>Branch : <?php echo $branch; ?></p>
                        <?php $year="20".$det['rollno'][1].$det['rollno'][2]; ?>
                        <p>Month and Year : <?php echo $year; ?></p>
                    </div>
                    
                    <div class="container">
                        <!-- <div class="row" style="border : 1px solid red ">
                            <div class="col-xs-2" id="p1">Sno</div>
                            <div class="col-xs-2 col-half-offset" id="p2">Subject code</div>
                            <div class="col-xs-2 col-half-offset" id="p3">Subject</div>
                            <div class="col-xs-2 col-half-offset" id="p4">Grade</div>
                            <div class="col-xs-2 col-half-offset" id="p5">Credits</div>
                            </div>
                                          </div>-->  
                        <table style="width:95%;">
                            <tr>
                                <th>Sno</th>
                                <th>Subject code</th>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th>Credits</th>
                            </tr>
                            <?php 
                            for ($i=0;$i<$len;$i++) { 
                            ?>
                            <tr>
                                <td style="width: 20px;"><?php echo ($i+1)."." ?></td>
                                <td style="width: 20px;"><?php echo $sub_code[$i]; ?></td>
                                <td style="width: 600px;"><?php echo $sub[$i]; ?></td>
                                <td><?php echo $row['s'.(string)($i+1)]; ?></td>
                                <td><?php if($row['s'.(string)($i+1)]!="F") echo $credits[$i]; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                        <br>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-sm-6">SGPA : </div>
                            <div class="col-sm-6"><?php echo $row['sgpa']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">CGPA : </div>
                            <div class="col-sm-6"><?php echo $row['cgpa']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">Total Credits : </div>
                            <div class="col-sm-6"><?php echo $tot_credits; ?></div>
                        </div>
                    </div>
                    <div class="col-sm-4" style="height: 50px;"></div>
                </div>
            </div>
        <?php } ?>
        </div>
        <?php include ("../footer.php"); ?>

    </body>
</html>