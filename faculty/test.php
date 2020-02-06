<?php

if (isset($_GET['submit']))
{
  // echo "hello";
    $db = mysqli_connect("localhost", "root", "", "student_info");
    $qry = "SHOW columns from details";
    $res = mysqli_query($db,$qry);
    
    $row = mysqli_fetch_array($res);
    echo $row['Field']."<br>";

    $myPost = array_values($_GET);
    echo $myPost[0];
    echo $myPost[1];
}

?>

<form>
  <input type="text" name="a" value="a">
  <input type="text" name="b">
  <input type="text" name="c">
  <input type="submit" name="submit">
</form>