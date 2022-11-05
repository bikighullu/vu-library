<?php
session_start();
if(!isset($_SESSION['slogin']))
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
                        <h3>Books Issued</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>List of books issued</h2>

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
                                            <th>Due Date</th>
                                            <th>Fine </th>
                                            <th> Book Return Date</th>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $studid= $_SESSION['slogin'];
                                    $sql = "SELECT Student.firstname,Student.lastname,book.bookname,book.isbn,bookissue.bookissued,bookissue.bookreturned,bookissue.exissue, bookissue.fine, bookissue.bookid,bookissue.studentid,bookissue.returnstatus,bookissue.issueid as rid from  bookissue join Student  on Student.studentid=bookissue.studentid AND Student.studentid=$studid join book on book.isbn=bookissue.bookid order by bookissue.issueid desc";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {    
                                    $exissue=$result->exissue;           ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->firstname);?></td>
                                            <td class="center"><?php echo htmlentities($result->lastname);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookname);?></td>
                                            <td class="center"><?php echo htmlentities($result->isbn);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookissued);?></td>

                                            <td class="center"><?php echo htmlentities($result->exissue);?></td>
                                            <?php $nowdate= date('Y-m-d G:i:s'); 


                                            if($result->fine==1)
                                            {
                                                $mainfine="Cleared";?>
                                                <td class="center"><?php echo htmlentities($mainfine);?></td><?php
                                            }
                                            else
                                            {

                                            if($nowdate>$exissue)
                                            {

                                                $mainfine= "$15";?>
                                              <td class="center"><?php echo htmlentities($mainfine);?></td><?php
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

       