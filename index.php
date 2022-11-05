<?php
session_start();
include("include/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Login </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/custom.min.css" rel="stylesheet">
</head>

<br>

<div class="col-lg-12 text-center ">
    <h1 style="font-family:Lucida Console">VU Library Management System</h1>
</div>

<br>

<body class="login">


<div class="login_wrapper">

    <section class="login_content">
        <form name="form1" action="" method="post">
            <h1>Student Login</h1>

            <div>
                <input type="text" name="studentid" class="form-control" placeholder="StudentID" required=""/>
            </div>
            <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required=""/>
            </div>
            <div>

                <input class="btn btn-default submit" type="submit" name="submit" value="Login">
       
            </div>

            <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">New to site?
                    <a href="registration.php"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br/>


            </div>
        </form>
    </section>



</div>

<?php
if(isset($_POST["submit"]))
{
    $studentid=$_POST['studentid'];
    $password=md5($_POST['password']);
 

 $sql ="SELECT * FROM Student WHERE studentid=:studentid and password=:password and status=1";
$query= $dbh -> prepare($sql);
$query-> bindParam(':studentid', $studentid, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
    $_SESSION['slogin']=$_POST['studentid'];?>

    <script type="text/javascript">
    window.location="viewbook.php"; 
</script>

<?
}
else 
{
    ?>

<div class="alert alert-danger col-lg-6 col-lg-push-3">
    <strong style="color:white"> Invalid </strong> Username Or Password.
</div>
<?php
}
}
?>




</body>
</html>

