<?php
    session_start();
    include ("../header.php");
    include ("../db.php");
    
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


    if (isset($_POST['update']))
    {
        
    }
    
    $un = $_SESSION['username'];
    $qry = "SELECT * from details where rollno='$un'";
    $res = mysqli_query($conn, $qry);
    $row = mysqli_fetch_array($res);
    
?>
<!DOCTYPE html>
<head>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.3.4.1.css">
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script> -->
    <style>
        h1{
        font-size:200%;
        color:black;
        padding:20px;
        /*border:double;*/
        text-align: center;
        }
        h2
        {
        font-size:150%;
        text-align:center;
        }
        body
        {
        /*background-image: url('details_bg.jpg');*/
        /*background: linear-gradient(to right, #1CB5E0, #000046);
        background-position: center center;
        background-size: cover;
        background-attachment: fixed;*/
        background: #24C6DC;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #514A9D, #24C6DC);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #514A9D, #24C6DC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
        .card
        {
        background-color: white;
        border-radius: 25px;
        box-shadow: 0 15px 25px rgba(0,0,0,0.5);
        height: 600px; 
        }
        .card .input
        {
        display: block;
        width: 100%;
        padding: 3px;
        }
        .card .design
        {
        text-align: center;
        font-size: 20px;
        margin-top: 10px;
        }
        .cards
        {
        background-color: white;
        border-radius: 25px;
        box-shadow: 0 15px 25px rgba(0,0,0,0.5);
        height: 400px; 
        }
        .cards .input
        {
        display: block;
        width: 100%;
        padding: 3px;
        }
        .cards .design
        {
        text-align: center;
        font-size: 20px;
        margin-top: 10px;
        }
        .pic
        {
        background-color: white;
        background-image: url(user.png);
        width: 200px;
        height: 200px;
        margin-left :100px;
        margin-top :30px;
        position: fixed;
        }
        .submit
        {
        width: 150px;
        height: 40px;
        margin-left: 550px;
        margin-bottom: 50px;
        background-color: rgba(248, 148, 6, 1);
        color: white;
        border: none;
        outline: none;
        border-radius: 30px;
        }
    </style>
</head>
<body>
    <div class="body" style="background: linear-gradient(to right, #514A9D, #24C6DC);">
        <h2 align="center">Student Details</h2>
        <!-- <marquee behaviour="scroll" direction="left" scrollamount="10"><font size="+2">This information is regarding with your placements,please make sure you fill correct details</font></marquee> -->
        <h2 align="center">Please fill your details here</h2>
        <div style="width: 100%; text-align: center; color: #fff;">(This information is regarding with your placements,please make sure you fill correct details)</div>
        <div class="container" style="margin-top: 30px;">
            <div class="row">
                <form method="post">
                <div class="col-sm-4 card">
                    <p class="design">PERSONAL DETAILS</p>
                    <br></br>
                    <div class="col-sm-4"><div style="width: 110%;">Student name:</div></div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter the name" value="<?php echo $row['name'] ?>" name="name" required></div>
                    <br></br>
                    <?php 
                        $date=date_create($row['dob']);
                        $date = date_format($date,"Y-m-d");
                        ?>
                    <div class="col-sm-4">dob:</div>
                    <div class="col-sm-8"><input class="input" type="date" placeholder="enter the date" value="<?php echo $date; ?>" name="dob" required></div>
                    <br></br>
                    <div class="col-sm-4">Religion:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter the religion" value="<?php echo $row['religion'] ?>" name="religion" required></div>
                    <br></br>
                    <div class="col-sm-4">caste:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter the caste" value="<?php echo $row['caste'] ?>" name="caste" required></div>
                    <br></br>
                    <div class="col-sm-4">Gender:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter the gender" value="<?php echo $row['gender'] ?>" name="gender" required></div>
                    <br></br>
                    <div class="col-sm-4">Height:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter your height in cm" value="<?php echo $row['height'] ?>" name="height" required></div>
                    <br></br>
                    <div class="col-sm-4">Weight:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter your weight in kgs"  value="<?php echo $row['weight'] ?>" name="weight" required></div>
                    <br></br>
                    <div class="col-sm-4">Eyesight:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter yes/no"  value="<?php echo $row['eyesight'] ?>"name="eyesight" required></div>
                    <br></br>
                    <div class="col-sm-4">Blood group:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter your bloodgroup eg O+" value="<?php echo $row['bloodgroup'] ?>" name="bloodgroup" required></div>
                    <br></br>
                    <div class="col-sm-4">Mobile no:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="+91"  value="<?php echo $row['mobile'] ?>"name="mobile" required></div>
                    <br></br>
                    <div class="col-sm-4">Clg email id:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="username@domain"  value="<?php echo $row['college_email_id'] ?>"name="college_email_id" required></div>
                    <br></br>
                    <div class="col-sm-4">Address:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter your residential address" value="<?php echo $row['address'] ?>" name="address" required></div>
                    <br></br>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4 cards">
                    <p class="design">PARENT DETAILS</p>
                    <br><br>
                    <div class="col-sm-5">parent name:</div>
                    <div class="col-sm-7"><input class="input" type="text" placeholder="enter your parent name"value="<?php echo $row['parent'] ?>" name="parent" required></div>
                    <br></br>
                    <div class="col-sm-5">Mobile number:</div>
                    <div class="col-sm-7"><input class="input" type="number" placeholder="+91"value="<?php echo $row['parent_mobile'] ?>" name="parent_mobile" required></div>
                    <br></br>
                    <div class="col-sm-5">Occupation</div>
                    <div class="col-sm-7"><input class="input" type="text" placeholder="enter occuption"value="<?php echo $row['parent_occupation'] ?>" name="parent_occupation" required></div>
                    <br></br>
                    <div class="col-sm-5">Parent email id</div>
                    <div class="col-sm-7"><input class="input" type="text" placeholder="xyz@domain.com"value="<?php echo $row['parent_email_id'] ?>" name="parent_email_id" required></div>
                    <br></br>
                </div>
                <div class="col-sm-3">
                    <div class="pic"></div>
                </div>
            </div>
            <br></br>
            <br></br>
            <div class="row">
                <div class="col-sm-4 cards">
                    <p class="design">SSC</p>
                    <div class="col-sm-4">SSC cgpa:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter your ssc cgpa"value="<?php echo $row['ssc-cgpa'] ?>" name="ssc-cgpa" required></div>
                    <br></br>
                    <div class="col-sm-4">SSC %:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter your ssc percentage" value="<?php echo $row['ssc-percentage'] ?>"name="ssc-percentage" required></div>
                    <br></br>
                    <div class="col-sm-4">SSC YOP:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter year of passing"value="<?php echo $row['ssc yop'] ?>" name="ssc yop" required></div>
                    <br></br>
                    <div class="col-sm-4">SSC school:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter school name"value="<?php echo $row['ssc school'] ?>" name="ssc school" required></div>
                    <br></br>
                    <div class="col-sm-4">SSC city:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter ssc city"value="<?php echo $row['ssc city'] ?>"name="ssc city" required></div>
                    <br></br>
                    <div class="col-sm-4">SSC medium:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter ssc medium"value="<?php echo $row['ssc medium'] ?>" name="ssc medium" required></div>
                    <br></br>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4 cards">
                    <p class="design">DIP</p>
                    <div class="col-sm-4">DIP cgpa:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter your dip cgpa"value="<?php echo $row['dip-cgpa'] ?>" name="dip-cgpa" ></div>
                    <br></br>
                    <div class="col-sm-4">DIP %:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter your dip percentage"value="<?php echo $row['dip percentage'] ?>" name="dip percentage" ></div>
                    <br></br>
                    <div class="col-sm-4">DIP YOP:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter year of passing"value="<?php echo $row['dip yop'] ?>" name="dip yop" ></div>
                    <br></br>
                    <div class="col-sm-4">DIP board:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter dip board"value="<?php echo $row['dip board'] ?>" name="dip board" ></div>
                    <br></br>
                    <div class="col-sm-4">DIP college:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter dip college"value="<?php echo $row['dip college'] ?>" name="dip college" ></div>
                    <br></br>
                    <div class="col-sm-4">DIP city:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter dip city"value="<?php echo $row['dip city'] ?>" name="dip city" ></div>
                    <br></br>
                    <div class="col-sm-4">DIP medium:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter dip medium"value="<?php echo $row['dip medium'] ?>"name="dip medium" ></div>
                    <br></br>
                </div>
                <div class="col-sm-3"></div>
            </div>
            <br></br>
            <br></br>
            <div class="row">
                <div class="col-sm-4 cards">
                    <p class="design">12th</p>
                    <div class="col-sm-4">12th cgpa:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter your 12th cgpa" value="<?php echo $row['12th-cgpa'] ?>"name="12th-cgpa" ></div>
                    <br></br>
                    <div class="col-sm-4">12th %:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter your 12th percentage"value="<?php echo $row['12th percentage'] ?>" name="12th percentage" ></div>
                    <br></br>
                    <div class="col-sm-4">12th YOP:</div>
                    <div class="col-sm-8"><input class="input" type="number" placeholder="enter year of passing" value="<?php echo $row['12th yop'] ?>"name="12th yop" ></div>
                    <br></br>
                    <div class="col-sm-4">12th college:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter 12th name"value="<?php echo $row['12th college'] ?>" name="12th college" ></div>
                    <br></br>
                    <div class="col-sm-4">12th city:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter 12th city" value="<?php echo $row['12th city'] ?>"name="12th city"></div>
                    <br></br>
                    <div class="col-sm-4">12th medium:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter ssc medium"value="<?php echo $row['12th medium'] ?>" name="12th medium" required></div>
                    <br></br>
                    <div class="col-sm-4">12th group:</div>
                    <div class="col-sm-8"><input class="input" type="text" placeholder="enter 12th group"value="<?php echo $row['12th group'] ?>" name="12th group" ></div>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4 cards">
                    <p class="design">EXTRA  DETAILS</p>
                    <div class="col-sm-6"> Aadhar number</div>
                    <div class="col-sm-6"><input class="input" type="number" placeholder="aadhar number"value="<?php echo $row['aadhar'] ?>" name="aadhar" required></div>
                    <br></br>
                    <div class="col-sm-6"> PAN number</div>
                    <div class="col-sm-6"><input class="input" type="text" placeholder="paan number"value="<?php echo $row['pan card'] ?>" name="pan card" required></div>
                    <br></br>
                    <div class="col-sm-6">Interested placements</div>
                    <div class="col-sm-6"><input class="input" type="text" placeholder="enter yes/no"value="<?php echo $row['interested placements'] ?>" name="interested placements" required></div>
                    <br></br>
                    <div class="col-sm-6">Interested in higher studies</div>
                    <div class="col-sm-6"><input class="input" type="text" placeholder="enter yes/no"value="<?php echo $row['interested higher studies'] ?>" name="interested higher studies" required></div>
                    <br></br>
                    <br></br>
                    <div class="col-sm-6">Name of company</div>
                    <div class="col-sm-6"><input class="input" type="text" placeholder="enter company name"value="<?php echo $row['name of the company'] ?>" name="name of company" required></div>
                    <br></br>
                    <div class="col-sm-6">declaration form submitted</div>
                    <div class="col-sm-6"><input class="input" type="text" placeholder="enter either yes/no" value="<?php echo $row['declaration form submitted (y/n)'] ?>" name="declaration form submitted"></div>
                    <br></br>
                    <br>
                    <div class="col-sm-6">Remarks</div>
                    <div class="col-sm-6"><input class="input" type="text" placeholder="enter your remarks" value="<?php echo $row['remarks'] ?>" name="remarks"></div>
                    <br></br>
                </div>
                <div class="col-sm-3"></div>

            </div>
        </div>
        <br></br>
        <br></br>
        <input type="submit" class="submit" name="update" value="Update"></button>
    </div>
</form>
</div>
</div>
</div>
    <?php include ("../footer.php"); ?>
</body>
</html>