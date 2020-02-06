<?php
  // session_start();
  include ("../db.php");
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
    header("Location: ../");
  }

  $un = $_SESSION['username'];
  $qry = "SELECT * from details where rollno='$un'";
  $res = mysqli_query($conn, $qry);
  $row = mysqli_fetch_array($res);

  if (isset($_POST['pic_upload']))
  {
    echo "Hello";
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]))
    {
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes))
        {
            // Upload file to server
            move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        }
        else
        {
            // $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    }
  }

  if(isset($_POST['submit']))
 {
  $name=$_POST['dname'];
  $dob=$_POST['ddob'];
  $rel=$_POST['dreligion'];
  $caste=$_POST['dcaste'];
  $gen=$_POST['dgender'];
  $hei=$_POST['dheight'];
  $wei=$_POST['dweight'];
  $eye=$_POST['deyesight'];
  $bl=$_POST['dbloodgroup'];
  $email=$_POST['dclgmail'];
$mobile = $_POST['dmobile'];
$address = $_POST['dadd'];
$pname=$_POST['dparent'];
$pocc=$_POST['dparent_occupation'];
$pemail=$_POST['dparentmail'];
$pmobile=$_POST['dparent_mobile'];
$syear=$_POST['sscyop'];
$sbo=$_POST['sscboard'];
$sper=$_POST['sscper'];
$scgpa=$_POST['ssccgpa'];
$smed=$_POST['sscmedium'];
$ssch=$_POST['sscschool'];
$scity=$_POST['ssccity'];
$tcgpa=$_POST['12thcgpa'];
$tper=$_POST['12thpercentage'];
$tyop=$_POST['12thyop'];
$tboard=$_POST['12thboard'];
$tclg=$_POST['12thcollege'];
$tgrp=$_POST['12thgroup'];
$tcity=$_POST['12thcity'];
$tmed=$_POST['12thmedium'];
$dcgpa=$_POST['dipcgpa'];
$dper=$_POST['dippercentage'];
$dyop=$_POST['dipyop'];
$dboard=$_POST['dipboard'];
$dclg=$_POST['dipcollege'];
$dgrp=$_POST['dipgroup'];
$dcity=$_POST['dipcity'];
$dmed=$_POST['dipmedium'];
$eac=$_POST['eamcetrank'];
$ecet=$_POST['ecetrank'];
$aa=$_POST['aadharr'];
$pan=$_POST['pan'];
$inp=$_POST['inplace'];
$ins=$_POST['instudies'];
$noc=$_POST['noc'];
$re=$_POST['re'];
$de=$_POST['dfs'];
$query = "UPDATE details set name='$name', mobile='$mobile',address='$address',dob='$dob',religion='$rel',caste='$caste',gender='$gen',height='$hei',weight='$wei',eyesight='$eye',bloodgroup='$bl',college_email_id='$email',parent='$pname',parent_occupation='$pocc',parent_email_id='$pemail',parent_mobile='$pmobile', `ssc yop`='$syear',`ssc-cgpa`='$scgpa',`ssc board`='$sbo',`ssc school`='$ssch',`ssc-percentage`='$sper',`ssc medium`='$smed',`ssc school`='$ssch',`ssc city`='$scity',`12th-cgpa`='$tcgpa',`12th percentage`='$tper',`12th yop`='$tyop',`12th board`='$tboard',`12th college`='$tclg',`12th group`='$tclg',`12th city`='$tcity',`12th medium`='$tmed',`dip-cgpa`='$dcgpa',`dip percentage`='$dper',`dip yop`='$dyop',`dip board`='$dboard',`dip college`='$dclg',`dip group`='$dgrp',`dip city`='$dcity',`dip medium`='$dmed',`rank-eamcet/nri`='$eac',`rank-ecet`='$ecet',`pan card`='$pan',`interested placements`='$inp',`interested higher studies`='$ins',`name of the company`='$noc',`remarks`='$re', `aadhar`='$aa', `declaration form submitted (y/n)`='$de' where rollno='$un'";
$res=mysqli_query($conn,$query);
$tri="SELECT * from details where rollno='$un'";
  $rese = mysqli_query($conn, $tri);
  $row = mysqli_fetch_array($rese);
 }
  

?>


<!DOCTYPE html>
<head>
  <title>Details</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
	height: 420px; 

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
  /*padding-bottom: 20px;*/
}
/*.pic
{
background-color: white;
background-image: url(user.png);
width: 200px;
height: 200px;
margin-left :100px;
margin-top :30px;
position: fixed;
}*/

/*.pic:hover ~ .pic_upload
{
  display: block;
}*/

.pic
{
  background-color: white;
  /*position: fixed;*/
  margin-left : 1000px;
  margin-top :155px;
  position: fixed;
  border-radius: 25px;
  box-shadow: 0 15px 25px rgba(0,0,0,0.5);
  height: 300px;
  width: 300px;
  /*margin-top: 100px;*/

}
.pic img
{
/*background-color: rgba(0,0,0,0.5);*/
content: url(<?php echo  "uploads/pictures/".$_SESSION['username'].".jpg"; ?>);
/*background-image: url(user.png);*/
/*width: auto;*/
width: 200px;
height: 200px;
border-radius: 50%;
/*margin-left : 1081px;*/
margin-left: 51px;
margin-top :5px;
position: fixed;
/*z-index: 4000;*/
/*display: none;*/
}
.pic_upload
{
background-color: rgba(0,0,0,0.5);
width: 200px;
height: 200px;
margin-left : 1051px;
margin-top :160px;
position: fixed;
border-radius: 50%;
/*display: none;*/
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
      <div class="card_fixed pic"><img src=""></div>
      <div class="pic_upload">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input style="margin-left: 52px;margin-top: 160px;color: transparent;" type="file" name="file">
            <input style="margin-left: 67px;" type="submit" name="submit" value="Upload">
        </form>
      </div>


	<form class='form' method="post" onsubmit="validate()">

 <h2 align="center">Student Details</h2>
 <!-- <marquee behaviour="scroll" direction="left" scrollamount="10"><font size="+2">This information is regarding with your placements,please make sure you fill correct details</font></marquee> -->
 <h2 align="center">Please fill your details here</h2>
<div style="width: 100%; text-align: center; color: #fff;">(This information is regarding with your placements,please make sure you fill correct details)</div>


<div class="container" style="margin-top: 30px;">
 	<div class="row">
 		<div class="col-sm-4 card">
 			<p class="design">PERSONAL DETAILS</p>
<br></br>
 			
                    <div class="col-sm-4"><div style="width: 110%;">Student name:</div></div>

 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter the name" value="<?php echo $row['name'] ?>" name="dname" required></div>
<br></br>
                        
 			<div class="col-sm-4">dob:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter the date" value="<?php echo $row['dob'] ?>" name="ddob" required></div>
<br></br>

 			<div class="col-sm-4">Religion:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter the religion" value="<?php echo $row['religion'] ?>" name="dreligion" required></div>
<br></br>

 			<div class="col-sm-4">caste:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter the caste" value="<?php echo $row['caste'] ?>" name="dcaste" required></div>
<br></br>

 			<div class="col-sm-4">Gender:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter the gender" value="<?php echo $row['gender'] ?>" name="dgender" required></div>
 			
<br></br>

 			<div class="col-sm-4">Height:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter your height in cm" value="<?php echo $row['height'] ?>" name="dheight" required></div>
<br></br>

 			<div class="col-sm-4">Weight:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter your weight in kgs"  value="<?php echo $row['weight'] ?>" name="dweight" required></div>
<br></br>

 			<div class="col-sm-4">Eyesight:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter yes/no"  value="<?php echo $row['eyesight'] ?>"name="deyesight" required></div>
<br></br>

 			<div class="col-sm-4">Blood group:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter your bloodgroup eg O+" value="<?php echo $row['bloodgroup'] ?>" name="dbloodgroup" required></div>
<br></br>

 			<div class="col-sm-4">Mobile no:</div>
 			<div class="col-sm-8"><input class="input" type="number" placeholder="+91"  value="<?php echo $row['mobile'] ?>"name="dmobile" required></div>
<br></br>

 			<div class="col-sm-4">Clg email id:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="username@domain"  value="<?php echo $row['college_email_id'] ?>"name="dclgmail" required></div>
<br></br>

 			<div class="col-sm-4">Address:</div>
 			<div class="col-sm-8"><input class="input" type="text" placeholder="enter your residential address" value="<?php echo $row['address'] ?>" name="dadd" required></div>
<br></br>

 		</div>

 		<div class="col-sm-1"></div>
 		<div class="col-sm-4 cards">
 			<p class="design">PARENT DETAILS</p>
<br><br>
			<div class="col-sm-5">parent name:</div>
 			<div class="col-sm-7"><input class="input" type="text" placeholder="enter your parent name"value="<?php echo $row['parent'] ?>" name="dparent" required></div>
<br></br>
<div class="col-sm-5">Mobile number:</div>
 			<div class="col-sm-7"><input class="input" type="number" placeholder="+91"value="<?php echo $row['parent_mobile'] ?>" name="dparent_mobile" required></div>
<br></br>
<div class="col-sm-5">Occupation</div>
 			<div class="col-sm-7"><input class="input" type="text" placeholder="enter occuption"value="<?php echo $row['parent_occupation'] ?>" name="dparent_occupation" required></div>
<br></br>
<div class="col-sm-5">Parent email id</div>
 			<div class="col-sm-7"><input class="input" type="text" placeholder="xyz@domain.com"value="<?php echo $row['parent_email_id'] ?>" name="dparentmail" required></div>
<br></br>
<p class="design">EAMCET/ECET</p>
<br>
<div class="col-sm-5">eamcet rank</div>
 			<div class="col-sm-7"><input class="input" type="number" placeholder="eamcet rank"value="<?php echo $row['rank-eamcet/nri'] ?>" name="eamcetrank" required></div>
<br></br>
<div class="col-sm-5">ecet rank</div>
 			<div class="col-sm-7"><input class="input" type="text" placeholder="ecet rank"value="<?php echo $row['rank-ecet'] ?>" name="ecetrank" required></div>


</div>


<script type="text/javascript">
  var r = /^anil+/.test("anil");
  console.log(r);
</script>
 
    <!-- <div class="col-sm-3"><div class="pic"></div></div>
 		<div class="col-sm-3"><div style="padding-left: 70px;padding-top: 70px;" class="pic_upload"> -->
      <div class="col-sm-3"></div>
    <div class="col-sm-3"><div style="padding-left: 70px;padding-top: 70px;" class="pic_upload">
     <!-- <a style="" href="#" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-edit"></span></a>  -->
     <!-- <form method="post" id="picture_upload" action="upload/upload.php" enctype="multipart/form-data"> -->
  <!--     <input type="file" id="picture" class="btn btn-info btn-lg" name="picture"><span class="glyphicon glyphicon-edit"></span>
    <input type="submit" name="picture_upload" value="Upload"> -->
    <!-- <form action="upload.php" method="post" enctype="multipart/form-data"> -->
        <!-- <input type="file" name="file">
        <input type="submit" name="pic_upload" value="Upload"> -->
    <!-- </form> -->

     <!-- </form> -->
    </div></div>






 	</div>
<br></br>
<br></br>
<div class="row">
 <div class="col-sm-4 cards">
<p class="design">SSC</p>

    <div class="col-sm-4">SSC cgpa:</div>
<div class="col-sm-8"><input class="input" type="number" placeholder="enter your ssc cgpa"value="<?php echo $row['ssc-cgpa'] ?>" name="ssccgpa" required></div>
<br></br>
 <div class="col-sm-4">SSC %:</div>
<div class="col-sm-8"><input class="input" type="number" placeholder="enter your ssc percentage" value="<?php echo $row['ssc-percentage'] ?>"name="sscper" required></div>
<br></br>
<div class="col-sm-4">SSC YOP:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter year of passing"value="<?php echo $row['ssc yop'] ?>" name="sscyop" required></div>
<br></br>
<div class="col-sm-4">SSC BOARD:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter ssc board"value="<?php echo $row['ssc board'] ?>" name="sscboard" required></div>
<br></br>
<div class="col-sm-4">SSC school:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter school name"value="<?php echo $row['ssc school'] ?>" name="sscschool" required></div>
<br></br>
<div class="col-sm-4">SSC city:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter ssc city"value="<?php echo $row['ssc city'] ?>"name="ssccity" required></div>
<br></br>
<div class="col-sm-4">SSC medium:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter ssc medium"value="<?php echo $row['ssc medium'] ?>" name="sscmedium" required></div>
<br></br>


</div>
<div class="col-sm-1"></div>
<div class="col-sm-4 cards">
<p class="design">DIP</p>

    <div class="col-sm-4">DIP cgpa:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter your dip cgpa"value="<?php echo $row['dip-cgpa'] ?>" name="dipcgpa" ></div>
<br></br>
 <div class="col-sm-4">DIP %:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter your dip percentage"value="<?php echo $row['dip percentage'] ?>" name="dippercentage" ></div>
<br></br>
<div class="col-sm-4">DIP YOP:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter year of passing"value="<?php echo $row['dip yop'] ?>" name="dipyop" ></div>
<br></br>
<div class="col-sm-4">DIP board:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter dip board"value="<?php echo $row['dip board'] ?>" name="dipboard" ></div>
<br></br>
<div class="col-sm-4">DIP GROUP:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter dip group" value="<?php echo $row['dip group'] ?>" name="dipgroup" ></div>
<br></br>
<div class="col-sm-4">DIP COLLEGE:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter dip college" value="<?php echo $row['dip college'] ?>" name="dipcollege" ></div>
<br></br>

<div class="col-sm-4">DIP city:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter dip city"value="<?php echo $row['dip city'] ?>" name="dipcity" ></div>
<br></br>
<div class="col-sm-4">DIP medium:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter dip medium"value="<?php echo $row['dip medium'] ?>"name="dipmedium" ></div>
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
 <div class="col-sm-8"><input class="input" type="text" placeholder="enter your 12th cgpa" value="<?php echo $row['12th-cgpa'] ?>"name="12thcgpa" ></div>
<br></br>
 <div class="col-sm-4">12th %:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter your 12th percentage"value="<?php echo $row['12th percentage'] ?>" name="12thpercentage" ></div>
<br></br>
<div class="col-sm-4">12th YOP:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter year of passing" value="<?php echo $row['12th yop'] ?>"name="12thyop" ></div>
<br></br>
<div class="col-sm-4">12th BOARD:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter the 12th board" value="<?php echo $row['12th board'] ?>"name="12thboard" ></div>
<br></br>
<div class="col-sm-4">12th college:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter 12th name"value="<?php echo $row['12th college'] ?>" name="12thcollege" ></div>
<br></br>
<div class="col-sm-4">12th city:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter 12th city" value="<?php echo $row['12th city'] ?>"name="12thcity"></div>
<br></br>
<div class="col-sm-4">12th medium:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter ssc medium"value="<?php echo $row['12th medium'] ?>" name="12thmedium" required></div>
<br></br>
<div class="col-sm-4">12th group:</div>
<div class="col-sm-8"><input class="input" type="text" placeholder="enter 12th group"value="<?php echo $row['12th group'] ?>" name="12thgroup" ></div>
</div>
<div class="col-sm-1"></div>
<div class="col-sm-4 cards">
	<p class="design">EXTRA  DETAILS</p>
<div class="col-sm-6"> Aadhar number</div>
 			<div class="col-sm-6"><input class="input" type="number" placeholder="aadhar number"value="<?php echo $row['aadhar'] ?>" name="aadharr" required></div>
<br></br>
<div class="col-sm-6"> PAN number</div>
 			<div class="col-sm-6"><input class="input" type="text" placeholder="paan number"value="<?php echo $row['pan card'] ?>" name="pan" required></div>
<br></br>
<div class="col-sm-6">Interested placements</div>
 			<div class="col-sm-6"><input class="input" type="text" placeholder="enter yes/no"value="<?php echo $row['interested placements'] ?>" name="inplace" required></div>
<br></br>
<div class="col-sm-6">Interested in higher studies</div>
 			<div class="col-sm-6"><input class="input" type="text" placeholder="enter yes/no"value="<?php echo $row['interested higher studies'] ?>" name="instudies" required></div>
<br></br>
<br></br>
<div class="col-sm-6">Name of company</div>
 			<div class="col-sm-6"><input class="input" type="text" placeholder="enter company name"value="<?php echo $row['name of the company'] ?>" name="noc" required></div>
<br></br>

<div class="col-sm-6">declaration form submitted</div>
 			<div class="col-sm-6"><input class="input" type="text" placeholder="enter either yes/no" value="<?php echo $row['declaration form submitted (y/n)'] ?>" name="dfs"></div>
<br></br>
<br></br>
<div class="col-sm-6">Remarks</div>
 			<div class="col-sm-6"><input class="input" type="text" placeholder="enter your remarks" value="<?php echo $row['remarks'] ?>" name="re"></div>
<br></br>
</div>
<div class="col-sm-3"></div>



</div>
</div>
<br></br>
<br></br>
<input class="submit" type="submit" value="update" name="submit">
</form>
</div>
    <?php include ("../footer.php"); ?>

</body>
<script>
	function validate()
	{
	var mobile=document.forms["form"]["dmobile"].value;
	var email=document.forms["form"]["dclgmail"].value;
	var pm=document.forms["form"]["dparent_mobile"].value;
	var em=document.forms["form"]["dparentmail"].value;
	var sg=document.forms["form"]["ssccgpa"].value;
	var sp=document.forms["form"]["sscper"].value;
	var tg=document.forms["form"]["12thcgpa"].value;
	var tp=document.forms["form"]["12thpercentage"].value;
	var dg=document.forms["form"]["dipcgpa"].value;
	var dp=document.forms["form"]["dippercentage"].value;
	var aad=document.forms["form"]["aadharr"].value;
	var paan=document.forms["form"]["pan"].value;
	var interestp=document.forms["form"]["inplace"].value;
	var interests=document.forms["form"]["instudies"].value;
	var dec=document.forms["form"]["dfs"].value;
	if(!/[0-9]{10}/.test(mobile))
	{
     alert("please enter valid phone number");
	}
	if(!/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})/.test(email))
	{
		alert ("please enter the valid email address");
	}
	if(!/[0-9]{10}/.test(pm))
	{
		alert("please enter valid parent mobile number");
	}
	if(!/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})/.test(pm))
	{
	alert("please enter valid email address of your parent");
	}
	if(!/[0.0-10.0]/.test(sg))
	{
		alert("please enter valid gpa of your ssc grade");
	}
	if(!/^[35-100]/.test(sp))
	{
		alert("please enter vlid percentage of your of your ssc marks");
	}
	if(!/^[0.0-10.0]/.test(tg))
	{
      alert("please enter valid gpa of your 12th marks");
	}
	if(!/^[35-100]/.test(tp))
	{
		alert("enter the valid percentage of your 12th standard");
	}
	if(!/^[0.0-10.0]/.test(dg))
	{
		alert("please enter the valid grade of polytechnic");
	}
	if(!/^[35-100]/.test(dp))
	{
		alert("please enter the valid percentage of polytechnic scrore");
	}
	if(!/[0-9]{12}/.test(aad))
	{
		alert("please enter valid aadhar number");
	}
	if(!/[A-Z0-9]{10}/.test(paan))
	{
		alert("please enter valid pan number");
	}
	if(!/[(yes)/(no)]/.test(interestp))
	{
		alert("please enter either yes or no in interest to higher studies column");
	}
	if(!/[(yes)/(no)]/.test(interests))
	{
		alert("please enter either yes or no in interest to higher studies column");
	}
	if(!/[(yes)/(no)]/.test(declare))
	{

			alert("please enter either yes or no in column of declerstion form submitted");
	}
}

// $('.pic').hover(()=>{
//   $('.pic_upload').toggle();
// });

$('.pic').mouseover(()=>{
  $('.pic_upload').show();
});
$('.pic').mouseout(()=>{
  $('.pic_upload').hide();
});


// document.getElementById("picture").onchange = function() {
//     document.getElementById("picture_upload").submit();
// };

</script>
</html>

