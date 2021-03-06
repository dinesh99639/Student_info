<?php 
set_time_limit(0);

function read_maintain()
{
  $file = "site_status.json";
  $json = json_decode(file_get_contents($file));
  return $json->val;
}

function alter_maintain()
{
  $file = "site_status.json";
  $json = json_decode(file_get_contents($file));
  if ($json->val==1) $json->val=0;  
  else $json->val=1;  
  file_put_contents($file, json_encode($json));
  header("Location:index.php");
}

if (isset($_GET['alter_maintain'])) alter_maintain ();



include("../header.php"); 
include("../db.php");
?>
<html>
   <head>
      <title>Admin</title>
      <link rel="stylesheet" type="text/css" href="style.css">

      <!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
      <script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
      <script type="text/javascript" src="../js/jquery.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script> -->
      <style type="text/css">
        @media (max-width:770px)
        {
          .sidebar
          {
            position: relative;
            /*display: none;*/
            /*background-color: #fff;*/
            width: 100%;
            height: auto;
          }
          input
          {
            width: 100%;
          }
          .col-sm-2
          {
            height: auto !important;
          }
        }
      </style>
   </head>
   <body>
      <div class="container" style="margin: 0; padding: 0; width: 100%;">
         <div class="row" style="margin: 0;">
            <div class="col-sm-2" style="height: 100%; padding: 0;">
               <div class="sidebar">
                 <a class="<?php if(isset($_GET['admin'])) echo "active"; ?>" href="index.php?admin=true">Admin</a>
                 <a class="<?php if(isset($_GET['stu_det'])) echo "active"; ?>" href="index.php?stu_det=true">Student Details</a>
                 <a class="<?php if(isset($_GET['sem_marks'])) echo "active"; ?>" href="index.php?sem_marks=true">Semester Marks</a>
               </div>
            </div>
            <!-- <div class="col-sm-1"></div> -->
            <div class="col-sm-9">
               <?php 
                if(isset($_GET['sem_marks'])) include ("sem_marks.php");
                else if(isset($_GET['stu_det'])) include ("stu_det.php");

                else { ?>
                  <div>
                   <div class="container">
                      <h3 style="text-align: center; margin-bottom: 40px;">Welcome Admin</h3>
                      <div class="row" style="margin-top: 30px;">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3">Site Status : </div>
                        <div class="col-sm-5"><button class="maintain" onclick="window.location.href='index.php?admin=true&alter_maintain=true'"></button></div>
                     </div>
                   </div>                 
                  </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </body>
</html>

<script>
  if (<?php echo read_maintain(); ?>==1) $('.maintain').text("In maintainance state");
  else $('.maintain').text("In Running state"); 
</script>