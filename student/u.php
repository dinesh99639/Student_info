<html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<style type="text/css">
.gallery.img{
	width:20%;
	height:auto;
	border-radius:5px;
	cursor:;
transition:.3s;

}
</style>
</head>
<body>
<div class="container">
<div class="upfrm">


<form action="upload.php" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>
</div>
</div>
</body>
</html>