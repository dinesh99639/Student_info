<h3 style="text-align: center; margin-bottom: 40px;">Add Semester Marks</h3>

<div class="container">
<form method="post" enctype="multipart/form-data">
  

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
      <div class="col-sm-6 input"><input style="" type="submit" name="upload_details" value="Upload"></div>
    </div>
  </div>
</div>
</form>

<?php if (isset($_POST['upload_details'])) { ?>
  <div class="row">
    <div class="col-sm-3"></div>
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

if(isset($_POST["upload_details"]))
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