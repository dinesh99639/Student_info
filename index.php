<!DOCTYPE html>
<html>

<head>
    <title>Project</title>

    <style type="text/css">
        body
        {
            /*background-image: linear-gradient( 109.2deg,  rgba(254,3,104,1) 9.3%, rgba(103,3,255,1) 89.5% );*/
            background-image: url(bg.jpg);
            background-size: cover;
            background-attachment: fixed;
        }

        .login
        {
            position: relative;
            margin: 60px 0;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            /*height: ght: 300px;*/
            width: 22%;
            min-width: 300px;
            background: white;
            padding: 40px;
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,0.5);
            border-radius: 5px;
            top: 250px;
            left: 50%;
            transform: translate(-50%,-50%);
        }

        .login .text
        {
            position: relative;
            margin-bottom: 50px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .login .input input
        {
            position: relative;
            /*border-radius: 10px;*/
            width: 100%;
            margin-bottom: 20px;
            border: none;
            border-bottom: 1px solid black;
            outline: none;
        }

        .login .submit
        {
            position: relative;
            /*width: 40px;*/
            /*left: 30%;*/
        }

        .login .submit input[type="submit"]
        {
            position: relative;
            width: 80%;
            top: 10px;
            left: 20px;
            margin-bottom: 20px;
            border: 1px solid black;
            border-radius: 30px;
            background-color: rgba(255,255,255,0.5);
        }
        .warning
        {
            position: absolute;
            margin-top: -100px;
            margin-left: -40px;
            width: 100%;
        }
    </style>
<!-- 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script> -->

</head>

<body>
    <?php include ("header.php"); ?>

    <div class="body">
        <div class="login">

            <?php
                if (isset($_GET['error']))
                {
                    if ($_GET['error']=="invalid_details") { ?>
                    <div class="alert alert-warning alert-dismissible fade in warning">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> Incorrect login details
                    </div>
                <?php }
                    if ($_GET['error']=="autherror") { ?>
                        <div class="alert alert-warning alert-dismissible fade in warning">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Warning!</strong> Access is restricted
                        </div>
                <?php } 
                } ?>

            <?php
                if (isset($_GET['register']))
                if ($_GET['register']=="success") { ?>
                <div class="alert alert-success alert-dismissible fade in warning">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Registration Success!</strong> Please login
                </div> 
            <?php } ?>

            <img src="student/user3.png" style="height: 100px; width: 100px; margin-top: -100px; margin-left: 60px;">
            <p class="text">Login</p>
            <form method="post" action="auth.php">
                <div class="input"><input type="text" name="username" placeholder="Username" required></div>
                <div class="input"><input type="password" name="password" placeholder="Password" required></div>
                <div class="submit"><input type="submit" name="login" value="Login"></div>
            </form>
        </div>

    </div>

</body>

</html>