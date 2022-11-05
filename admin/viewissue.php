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
if(isset($_GET['rid'])&&isset($_GET['bid']))
{
$rid=$_GET['rid'];
$bid=$_GET['bid'];

$fine=1;
$rstatus=1;
$bookreturned= date('Y-m-d G:i:s');

$sql="update bookissue set bookreturned=:bookreturned,returnstatus=:rstatus,fine=:fine where issueid=:rid";
$query = $dbh->prepare($sql);
$query->bindParam(':bookreturned',$bookreturned,PDO::PARAM_STR);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);


if($query->execute())
{   

       $usql="update book set status=0 where isbn=$bid";
        $querys = $dbh->prepare($usql);
        $querys->execute();
    if($querys->execute())
    {
?>
    <script type="text/javascript">
    alert("Book returned");
   </script>
<?
}
}
else
{
    ?>
    <script type="text/javascript">
    alert("Book not returned");
   </script>
<?
}

}
?>

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Issue of books</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Detail information regarding issuee</h2>

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
                                            <th>Issued Date</th>
                                            <th>Expected Return Date</th>
                                            <th>Fine</th>
                                            <th>Due Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sql = "SELECT Student.firstname,Student.lastname,book.bookname,book.isbn,bookissue.bookissued,bookissue.bookreturned, bookissue.exissue, bookissue.fine, bookissue.bookid,bookissue.returnstatus,bookissue.issueid as rid from  bookissue join Student on Student.studentid=bookissue.studentid join book on book.isbn=bookissue.bookid order by bookissue.issueid desc";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {      
                                    $bid=$result->isbn;
                                    $exissue=$result->exissue;



                                    


                                            ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->firstname);?></td>
                                            <td class="center"><?php echo htmlentities($result->lastname);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookname);?></td>
                                            <td class="center"><?php echo htmlentities($result->isbn);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookissued);?></td>


                                            <td class="center"><?php echo htmlentities($result->exissue);?></td>
                                            <?php

                                                $now= date('Y-m-d G:i:s');
                                                $nowdate= new DateTime($now); 
                                                $previousdate= new DateTime($exissue);
                                                $difference = $previousdate->diff($nowdate);
                                                $diff=$difference->d;

                                            

                                            if($result->fine==1)
                                            {
                                                $mainfine="Cleared";?>
                                                <td class="center"><?php echo htmlentities($mainfine);?></td><?php
                                            }
                                            else
                                            {

                                            if($now>$exissue)
                                            {

                                                $mainfine= $diff;?>
                                              <td class="center"><?php echo htmlentities("$".$mainfine);?></td><?php
                                            }
                                            else 
                                            {
                                           
                                               $mainfine= "no fine";
                                               ?>
                                              <td class="center"><?php echo htmlentities($mainfine);?></td><?php
                                            }
                                            }



                                            ?>




                                            <td class="center"><?php if($result->returnstatus==0)
                                            {
                                                echo htmlentities("Not Return Yet");
                                            } else {


                                            echo htmlentities($result->bookreturned);
}
                                            ?></td>
                                            <td class="center"><?php
                                                if($result->returnstatus==0)
                                            {?>

                                            <a href="viewissue.php?rid=<?php echo htmlentities($result->rid);?> & bid=<?php echo htmlentities($bid);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Return</button> <?}
                                            else
                                            {
                                                 echo htmlentities("Book returned");
                                            }
                                         ?>
                                            </td>
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
include("include/footer.php");
?>

       