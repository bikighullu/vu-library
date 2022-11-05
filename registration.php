
<?php
include("include/connect.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VU Library Student Registration</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/custom.min.css" rel="stylesheet">
</head>

<br>

<div class="col-lg-12 text-center ">
    <h1 style="font-family:Lucida Console">VU Library Management System</h1>
</div>


<body class="login" style="margin-top: -20px;">



    <div class="login_wrapper">

            <section class="login_content" style="margin-top: -40px;">
                <form name="form1" action="" method="post">
                    <h2>Student Registration</h2><br>

                    <div>
                        <input type="number" class="form-control" placeholder="StudentID" name="studentid" required=""/>
                    </div>
                    

                    <div>
                        <input type="text" class="form-control" placeholder="FirstName" name="firstname" required=""/>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="LastName" name="lastname" required=""/>
                    </div>

                  
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required=""/>
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="email" name="email" required=""/>
                    </div>
                    <div>
                        <input type="number" class="form-control" placeholder="contact" name="phone" required=""/>
                    </div>
                    <div class="col-lg-12  col-lg-push-3">
                        <input class="btn btn-default submit " type="submit" name="submit" value="Register">
                    </div>

                </form>
            </section>

<?php
if (isset($_POST["submit"]))
{
    
    $studentid= $_POST['studentid'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $password=md5($_POST['password']);
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $registrationdate = date('Y-m-d G:i:s');


    $sql="INSERT INTO Student VALUES('',:studentid,:firstname,:lastname,:password,:email,:phone,:registrationdate,0)";
    $query= $dbh->prepare($sql);
    $query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
    $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
    $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':phone',$phone,PDO::PARAM_STR);
    $query->bindParam(':registrationdate',$registrationdate,PDO::PARAM_STR);
        
    if($query->execute())
    {
    ?>
     <div class="alert alert-success col-lg-6 col-lg-push-6">
         Registration successfull. Please wait for admin's approval.
        <p class="change_link">Sign in
                    <a href="index.php"> click here </a>
        </p>

    </div>

    <?php
    }
    else 
    {
   
   ?>
     <div class="alert alert-success col-lg-6 col-lg-push-0">
        Please check you student id and try again.
       
    </div>

    <?php


    }
}

?>

    </div>

   

</body>
</html>
