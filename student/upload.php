<?php
session_start();
$rollno = $_SESSION['username'];

// File upload path
$targetDir = "uploads/pictures/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$uploadto = $targetDir.$rollno.".".$fileType;
// echo $uploadto;

$files1 = scandir($targetDir);
// print_r ($files1);


if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]))
{
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes))
    {
        // Upload file to server
        move_uploaded_file($_FILES["file"]["tmp_name"], $uploadto);
    }
    else
    {
        // $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}
header("Location:details.php");
?>