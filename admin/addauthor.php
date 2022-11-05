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
                        <h3>Add Author</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Enter the author's name</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form role="form" method="post">
                                    <div class="form-group">
                                    <label>Author Name</label>
                                    <input class="form-control" type="text" name="author" autocomplete="off"  required />
                                    </div>
                                  <button type="submit" name="create" class="btn btn-info">Add </button>
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
$author=$_POST['author'];
$authordate= date('Y-m-d G:i:s');
$sql="INSERT INTO  author VALUES('',:author,:authordate)";
$query = $dbh->prepare($sql);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':authordate',$authordate,PDO::PARAM_STR);

if($query->execute())
{
     ?>
   <script type="text/javascript">
    alert("Authors added succesfully");
   </script>
    <?php
     
}
else 
{
       ?>
   <script type="text/javascript">
    alert("Authors added fail. Please try again");
   </script>
    <?php

}

}
?>

<?php
include("include/footer.php");
?>

       