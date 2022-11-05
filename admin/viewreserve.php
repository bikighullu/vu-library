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
                        <h3>Books Reserved</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>List of books reserved</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student First Name</th>
                                            <th>Student Last Name</th>
                                            <th>Book Name</th>
                                            <th>ISBN </th>
                                            <th>Reserved Date</th>
                                            <th>Last date to issue</th>
                                            <th> Cancel book reservation</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    //$studid= $_SESSION['slogin'];
                                    $sql = "SELECT Student.firstname,Student.lastname,book.bookname,book.isbn,bookreserve.reserved,bookreserve.due,bookreserve.bookisbn,bookreserve.studentid,bookreserve.reserveid as rid from  bookreserve join Student  on Student.studentid=bookreserve.studentid  join book on book.isbn=bookreserve.bookisbn order by bookreserve.reserveid desc";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {    
                                          ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->firstname);?></td>
                                            <td class="center"><?php echo htmlentities($result->lastname);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookname);?></td>
                                            <td class="center"><?php echo htmlentities($result->isbn);?></td>
                                            <td class="center"><?php echo htmlentities($result->reserved);?></td>

                                            <td class="center"><?php echo htmlentities($result->due);?></td>



                                            <?php
                                            
                                                
                                                     
                                                $sql="SELECT * FROM bookreserve where bookisbn=$result->isbn";

                                                 $query = $dbh -> prepare($sql);
                                                $query->execute();
                                                $resultsr=$query->fetchAll(PDO::FETCH_OBJ);
                                              
                                                if($query->rowCount() > 0)

                                                { foreach($resultsr as $resultr)
                                                        { $nowdate= date('Y-m-d G:i:s');
                                                            $second=$resultr->due;
                                                        }
                                                        if($second<$nowdate)
                                                        {
                                                            $id=$result->isbn;
                                                            $rstatus=0;
                                                            $studentids=$_SESSION['slogin'];
                                                                $sql="update book set rstatus=:rstatus where isbn=:id";
                                                                $query = $dbh->prepare($sql);
                                                                $query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
                                                                $query->bindParam(':id',$id,PDO::PARAM_STR);
                                                                if($query->execute()){


                                                        $sql = "delete from bookreserve WHERE studentid=:studentids and bookisbn=:id";
                                                        $query = $dbh->prepare($sql);
                                                        $query -> bindParam(':studentids',$studentids, PDO::PARAM_STR);
                                                        $query -> bindParam(':id',$id, PDO::PARAM_STR);
                                                        $query -> execute();}

                                                        }
                                                        else{
                                                    ?>

                                                    <td class="center">

                                             
                                               <a href="viewreserve.php?bookcid=<?php echo htmlentities($result->isbn);?>" onclick="return confirm('Are you sure you want to cancel students book reservation?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Cancel reservation</button>
                                               </td>
                                                <?php

                                                
                                                }

                                                }

                                        
                                        ?>


                                            
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



 <?php
     if(isset($_GET['bookcid']))
{
        $id=$_GET['bookcid'];
        $rstatus=0;
        $sql="update book set rstatus=:rstatus where isbn=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
        $query->bindParam(':id',$id,PDO::PARAM_STR);
        $query->execute();


$sql = "delete from bookreserve WHERE bookisbn=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
 ?>
         <script type="text/javascript">
             alert("Book reservation canceled");
            window.location="viewreserve.php"; 
        </script>
        <?
}?>

<?php
include("include/footer.php");
?>

       