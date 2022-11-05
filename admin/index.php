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

    <title>Admin Login </title>

    <!-- Bootstrap -->
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
            <h1>Admin Login</h1>

            <div>
                <input type="text" name="email" class="form-control" placeholder="Enter username" required=""/>
            </div>
            <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required=""/>
            </div>
            <div>

                <input class="btn btn-default submit" type="submit" name="submit" value="Login">
                
            </div>

            <div class="clearfix"></div>

        </form>
    </section>



</div>

<?php
if(isset($_POST["submit"]))
{
    $email=$_POST['email'];
    $password=md5($_POST['password']);
 

 $sql ="SELECT * FROM admin WHERE username=:email and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{ 

 $_SESSION['sessionid']=$_POST['email'];
    ?>
    <script type="text/javascript">
    window.location="dashboard.php"; 
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

