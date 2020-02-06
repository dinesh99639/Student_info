<h3 style="text-align: center; margin-bottom: 40px;">Add Semester Marks</h3>

<div class="container">
<form method="post" enctype="multipart/form-data">
  
<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-7">
    <div class="row">
      <div class="col-sm-6" style="text-align: center;">Academic year : </div>
      <div class="col-sm-6 input"><input style="height: 25px;" type="text" name="academic_year"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-7">
    <div class="row">
      <div class="col-sm-6" style="text-align: center;">Year : </div>
      <div class="col-sm-6 input"><input style="height: 25px;" type="text" name="year"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-7">
    <div class="row">
      <div class="col-sm-6" style="text-align: center;">Semester : </div>
      <div class="col-sm-6 input"><input style="height: 25px;" type="text" name="semester"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-7">
    <div class="row">
      <div class="col-sm-6" style="text-align: center;">File Upload</div>
      <div class="col-sm-6 input"><input style="height: 25px;" type="file" name="file"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-7">
    <div class="row">
      <div class="col-sm-6" style="text-align: center;"></div>
      <div class="col-sm-6 input"><input style="" type="submit" name="upload_marks" value="Upload"></div>
    </div>
  </div>
</div>
</form>

<?php if (isset($_POST['upload_marks'])) { ?>
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
      <div style="text-align: center; width: 100%;"> 
        <div class="progress-bar progress-bar-striped" style="border-radius: 30px;"></div> 
      </div>
    </div>
    <div class="col-sm-2"></div>
  </div>

<?php } ?>

</div>

<?php

if(isset($_POST["upload_marks"]))
{
  $tb_name=$_POST['academic_year']."_".$_POST['year']."sem".$_POST['semester']."";

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
      ?><script type="text/javascript">//console.log(<?php echo count($file); ?>);</script><?php

      $tot=0;
      $tmpf = fopen($filename, "r");
      while (($tmp = fgetcsv($tmpf)) !== FALSE) $tot++;

      $subjects="";
      for ($i=1;$i<=$cols;$i++) $subjects=$subjects.", `s".$i."`";

      $c=0;
      while (($stu = fgetcsv($file)) !== FALSE)
      {
        $stu[0] = substr($stu[0],0,12);
        $val = implode('", "', $stu);
        $val = preg_replace("/[e\r]/", "", $val);
        // echo $val."<br>";
        $sql = "INSERT INTO `$tb_name`(`rollno`, `sgpa`, `cgpa`".$subjects.") VALUES (".'"'.$val.'"'.")";
        $result = mysqli_query($conn, $sql);

        $cgpa=$stu[2];
        $rno=$stu[0];
        // echo $cgpa." - ";
        // echo $rno."<br>";
        $sql = "UPDATE `details` set `b-tech cgpa`='$cgpa' where `rollno`='$rno'";
        $result = mysqli_query($conn, $sql);

        // echo $sql."<br>";
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
}


?>