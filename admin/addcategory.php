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
                        <h3>Categories</h3>
                    </div>

                    <div class="title_right">
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Add Category</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form role="form" method="post">
                                        <div class="form-group">
                                        <label>Category Name</label>
                                        <input class="form-control" type="text" name="category" autocomplete="off" required />
                                        </div>
                                        
                                        <button type="submit" name="create" class="btn btn-info">Create </button>

                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
if(isset($_POST['create']))
{
$categoryname=$_POST['category'];
$categorydate= date('Y-m-d G:i:s');


$sql="INSERT INTO  category VALUES('',:categoryname,:categorydate)";
$query = $dbh->prepare($sql);
$query->bindParam(':categoryname',$categoryname,PDO::PARAM_STR);
$query->bindParam(':categorydate',$categorydate,PDO::PARAM_STR);


if($query->execute())
{
     ?>
   <script type="text/javascript">
    alert("Categories inserted succesfully");
   </script>
    <?php
     
}
else 
{
       ?>
   <script type="text/javascript">
    alert("Categories insertion fail. Please try again");
   </script>
    <?php

}

}
?>

<?php include ("include/footer.php");