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
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $studid= $_SESSION['slogin'];
                                    $sql = "SELECT Student.firstname,Student.lastname,book.bookname,book.isbn,bookreserve.reserved,bookreserve.due,bookreserve.bookisbn,bookreserve.studentid,bookreserve.reserveid as rid from  bookreserve join Student  on Student.studentid=bookreserve.studentid AND Student.studentid=$studid join book on book.isbn=bookreserve.bookisbn order by bookreserve.reserveid desc";
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

       