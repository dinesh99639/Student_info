<?php
  session_start();
  include ("../db.php");

  $un = $_SESSION['username'];
  $qry = "SELECT * from details where rollno='$un'";
  $res = mysqli_query($conn, $qry);
  $row = mysqli_fetch_array($res);

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<!-- <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<style>

  body{
    background-color: #333333;
  }
.dropbtn {
  background-color: skyblue;
  color: white;
  padding: 6px 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #ffff99;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: white}

.dropdown:hover .dropdown-content {
  display: block;
}

.getmarks input
{
  position: relative;
  margin-left: 100px;
  background-color: skyblue;
  border: none;
  border-radius: 10px;
  outline: none;
  padding: 6px 25px;
}


input[type=text] {
  width: 275px;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

input[type=text]:focus {
  border: 3px solid #555;
}
input[type=Number] {
  width: 75px;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

input[type=Number]:focus {
  border: 3px solid #555;
}
/*
.container {
  position: absolute;
  top:20px;
  left:20px;
  padding: 40px;
}*/
input[type=marks] {
  width: 150px;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

input[type=marks]:focus {
  border: 3px solid #555;
}
</style>
</head>
<body>

  <div class="container" style="margin-top: 20px;">
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
       <h2 style="color: #ffff99; font-family: cursive; text-align: center;">MARKS</h2>
        
       <div class="row" style="margin-top: 20px;">
         <div class="col-sm-3"><label style="color: white;font-size: 28;font-family: cursive;" for="sname">Student Name : </label></div>
         <div class="col-sm-3"><label style="color: white;font-size: 28;font-family: cursive;" for="sname"><?php echo $row['name'] ; ?></label></div>
         <div class="col-sm-0"></div>
         <div class="col-sm-3"><label style="color: white;font-size: 28;font-family: cursive;" for="rno">Roll Number : </label></div>
         <div class="col-sm-3"><label style="color: white;font-size: 28;font-family: cursive;" for="rno"><?php echo $row['rollno'] ; ?></label></div>
       </div>


       <div class="row" style="margin-top: 20px;">
         <div class="col-sm-1"><span style="font-size: 22px; color: white;">Year </span></div>
         <div class="col-sm-3">
           <div class="dropdown">
            <form method="post"></form>
              <select style="color: black;" class="dropbtn">
              <div class="dropdown-content">
                <option value="first year">FIRST YEAR</option>
                <option value="second year">SECOND YEAR</option>
                <option value="third year">THIRD YEAR</option>
                <option value="fourth year">FOURTH YEAR</option>
             
              </div>
              </select>
              </div>
         </div>
         <div class="col-sm-2"><span style="font-size: 22px; color: white">Semester </span></div>
         <div class="col-sm-1">
          <div class="dropdown">
            <select style="color: black;" class="dropbtn">
            <div class="dropdown-content">
              <option value="sem1">FIRST SEM</option>
              <option value="sem2">SECOND SEM</option>
            </div>
          </select>
          </div>
         </div>
         <!-- <div class="col-sm-2"><input type="submit" name="get_marks" value="Get"></div> -->
         <div class="col-sm-2 getmarks"><input type="submit" name="getmarks"></div>
         </form>
       </div>


       <div class="row" style="margin-top: 50px;">
         <form style="color: white;font-family: cursive;size: 32; width: 100%;">

          <div class="row" style="margin-bottom: 30px;">
            <div class="col-sm-6">Subjects</div>
            <div class="col-sm-6">Marks</div>
          </div>

          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-6">Sub - 1 : </div>
            <div class="col-sm-6">97.5</div>
          </div>

          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-6">Sub - 2 : </div>
            <div class="col-sm-6">88.6</div>
          </div>

          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-6" >Sub - 3 : </div>
            <div class="col-sm-6">76.6</div>
          </div>


          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-6">Sub - 4 : </div>
            <div class="col-sm-6">70.6</div>
          </div>


          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-6">Sub - 5 : </div>
            <div class="col-sm-6">59.9</div>
          </div>


          <div class="row" style="margin-top: 50px;">
            <div class="col-sm-6">SGPA : </div>
            <div class="col-sm-6">9.5</div>
          </div>
          <div class="row" style="margin-top: 10px;">
            <div class="col-sm-6">CGPA : </div>
            <div class="col-sm-6">9.5</div>
          </div>



         </form>
       </div>

      </div>
      <div class="col-sm-2"></div>
    </div>
  </div>

<!--

<form style="color: white;font-family: cursive;size: 32;">
  <br>
  sub1: &nbsp<input type="Number" id="sub1" name="sub1"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
  sub2: &nbsp<input type="Number" id="sub2" name="sub2"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
  sub3: &nbsp<input type="Number" id="sub3" name="sub3"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <br>
  sub4: &nbsp<input type="Number" id="sub4" name="sub4"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
  sub5: &nbsp<input type="Number" id="sub5" name="sub5"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
  sub6: &nbsp<input type="Number" id="sub6" name="sub6">
  <br><br>
  <div style="color: skyblue;">
  SGPA: &nbsp<input type="marks" id="rno" name="rno"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
  CGPA: &nbsp<input type="marks" id="rno" name="rno">
</div>
</form>
</div1>
</div> -->
</body>
</html>