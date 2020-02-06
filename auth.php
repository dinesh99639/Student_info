<?php

session_start();

require("db.php");


if (isset($_POST['login']))
{
	$username = mysqli_escape_string($conn,$_POST['username']);
    $password = mysqli_escape_string($conn,$_POST['password']);
	// $password = md5(sha1(crypt($password,10)));

	$query = "SELECT * FROM users where username='$username' and password='$password'";
	$res = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($res);
    $sameusers = mysqli_num_rows($res);

    if ($sameusers==1)
    {
    	$login_success = 1;

        $query = "SELECT name FROM details where rollno='$username'";
        $name = mysqli_fetch_array(mysqli_query($conn, $query))['name'];
        // $sameusers = mysqli_num_rows($res);

    	$_SESSION['userid']=$row['userid'];
    	$_SESSION['username']=$row['username'];
    	$_SESSION['name']=$name;
    	$_SESSION['usertype']=$row['usertype'];

    	if ($_SESSION['usertype']=="student") header("Location:student/");
    	if ($_SESSION['usertype']=="faculty") header("Location:faculty/");
        if ($_SESSION['usertype']=="admin") header("Location:admin/");

    }
    else header("Location:index.php?error=invalid_details");
}

?>