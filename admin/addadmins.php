<?php
session_start();
if(!isset($_SESSION['sessionid']))
{
    ?>
    <script type="text/javascript">
    window.location="index.php";
    </script>
    <?php
}
include("include/header.php");
include("include/connect.php");
?>

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Create Admin</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Enter Admin details</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                
                                <form name="form1" action="" method="post">
                    <h2>Add Admin</h2><br>
                    <div>
                        <input type="text" class="form-control" placeholder="FirstName" name="firstname" required=""/>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="LastName" name="lastname" required=""/>
                    </div>

                     <div>
                        <input type="text" class="form-control" placeholder="Username" name="username" required=""/>
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="email" name="email" required=""/>
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required=""/>
                    </div>
                    
                    <div>
                        <input type="number" class="form-control" placeholder="contact" name="phone" required=""/>
                    </div>
                    <div class="col-lg-12  col-lg-push-3">
                        <input class="btn btn-default submit " type="submit" name="submit" value="Register">
                    </div>

                </form>
         

<?php
if (isset($_POST["submit"]))
{
    
    
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $lastname=$_POST['lastname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $phone=$_POST['phone'];
    $registrationdate = date('Y-m-d G:i:s');


    $sql="INSERT INTO admin VALUES('',:firstname,:lastname,:username, :email, :password,:phone,:registrationdate)";
    $query= $dbh->prepare($sql);
    $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
    $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':phone',$phone,PDO::PARAM_STR);
    $query->bindParam(':registrationdate',$registrationdate,PDO::PARAM_STR);
        
    if($query->execute())
    {
    ?>
     <div class="col-lg-12  col-lg-push-3">
         Admin registration complete. 
        <p class="change_link">Sign in
                    <a href="index.php"> click here </a>
        </p>

    </div>


    <?php
    }
    else
    {
        ?>
               <div class="col-lg-12  col-lg-push-3">
         Admin registration fail. Please check the details. 
        

    </div>
        <?php
    }
    
}

?>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
<?php
include("include/footer.php");
?>

       