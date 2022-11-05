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
<?php
if(isset($_GET['inid']))
{
$studentid=$_GET['inid'];
echo $studentid;
$sql = "update Student set status=:status  WHERE studentid=:studentid";
$query = $dbh->prepare($sql);
$query -> bindParam(':studentid',$studentid, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
?>
    <script type="text/javascript">
    window.location="viewstudents.php"; 
</script>

<?
}



//code for active students
if(isset($_GET['id']))
{
$studentid=$_GET['id'];
$status=1;
$sql = "update Student set status=:status  WHERE studentid=:studentid";
$query = $dbh->prepare($sql);
$query -> bindParam(':studentid',$studentid, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
?>
    <script type="text/javascript">
    window.location="viewstudents.php"; 
</script>

<?
}

?>

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>REGISTERED STUDENTS</h3>
                    </div>

                   
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Student Table</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                         
                               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            
                                            <th>Student ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email id </th>
                                            <th>Mobile Number</th>
                                            <th>Registration Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT * from Student";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
//$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                          
                                            <td class="center"><?php echo htmlentities($result->studentid);?></td>
                                            <td class="center"><?php echo htmlentities($result->firstname);?></td>
                                            <td class="center"><?php echo htmlentities($result->lastname);?></td>
                                            <td class="center"><?php echo htmlentities($result->email);?></td>
                                              <td class="center"><?php echo htmlentities($result->phone);?></td>
                                             <td class="center"><?php echo htmlentities($result->registrationdate);?></td>
                                            <td class="center"><?php if($result->status==1)
                                            {
                                                echo htmlentities("Active");
                                            } else {


                                            echo htmlentities("Blocked");
}
                                            ?></td>
                                            <td class="center">
<?php if($result->status==1)
 {?>
<a href="viewstudents.php?inid=<?php echo htmlentities($result->studentid);?>" onclick="return confirm('Are you sure you want to block this student?');"" >  <button class="btn btn-danger"> Inactive</button>
<?php } else {?>

                                            <a href="viewstudents.php?id=<?php echo htmlentities($result->studentid);?>" onclick="return confirm('Are you sure you want to activate this students account?');""><button class="btn btn-primary"> Active</button> 
                                            <?php } ?>
                                          
                                            </td>
                                        </tr>
 <?php }} ?>                                      
                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include("include/footer.php");
?>
       