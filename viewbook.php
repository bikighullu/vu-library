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
                        <h3>Books</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>View Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form name="form1" action="" method="post">
                                   <label> Search by<span style="color:red;">*</span></label>
                                   <input type="text" name="t1" class="form-control" >
                                   <select name="t2" class="form-control">
                                 
                                    <option value="isbn">ISBN</option>
                                    <option value="author">Author name</option>
                                    <option value="category">Category name</option>
                                    <option value="bookname" selected>Book Name</option>
                                    </select>
                                   
                                    <input type="submit" name="submit1" value="search books" class="btn btn-default">
                                </form>

                                <?php
                                if(isset($_POST["submit1"]))
                                {
                                ?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>ISBN</th>
                                            <th>Published Date</th>
                                            <th>Book added Date</th>
                                            <th> Status</th>
                                            <th> Request for book reserve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $search=$_POST['t1'];
                                    $selection=$_POST['t2'];
                                    if($selection=="isbn")
                                    {
                                        $search1="isbn";
                                        $head="book";
                                    }
                                    else if($selection=="author")
                                    {
                                        $search1="authorname";
                                        $head="author";
                                    }
                                    else if($selection=="bookname")
                                    {
                                        $search1="bookname";
                                        $head="book";
                                    }
                                    else if($selection=="category")
                                    {
                                        $search1="categoryname";
                                        $head="category";
                                    }


                                    $sql = "SELECT book.bookname,category.categoryname,author.authorname,book.isbn,book.bookpublish,book.bookadd,book.status,book.rstatus,book.bookid as bookid from book join author on author.authorid=book.authid join category on category.categoryid=book.catid  WHERE $head.$search1 like('%$search%')";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                   foreach($results as $result)
                                    {               ?>                                      
                                            <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookname);?></td>
                                            <td class="center"><?php echo htmlentities($result->authorname);?></td>
                                            <td class="center"><?php echo htmlentities($result->categoryname);?></td>
                                            <td class="center"><?php echo htmlentities($result->isbn);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookpublish);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookadd);?></td><?php
                                            if($result->status==1)
                                            {
                                                $status="Not available in library";
                                                $message="Book is not available for reserve"
                                               ?> <td class="center"><?php echo htmlentities($status);?></td>

                                                  <td class="center"><?php echo htmlentities($message);?></td>

                                               <?php

                                            }
                                            else
                                            {
                                                $status="Available";
                                                ?><td class="center"><?php echo htmlentities($status);?></td>




                                                <?php


                                                if($result->rstatus==1)
                                            {

                                                $checkid=$_SESSION['slogin'];
                                                $sql="SELECT * FROM bookreserve where studentid=$checkid and bookisbn=$result->isbn";

                                                 $query = $dbh -> prepare($sql);
                                                $query->execute();
                                                $resultsr=$query->fetchAll(PDO::FETCH_OBJ);
                                                 if($query->rowCount() > 0)

                                                { foreach($resultsr as $resultr)
                                                        { $nowdate= date('Y-m-d G:i:s');
                                                            $second="2018-11-19 00:00:00";
                                                        }
                                                        if($second>$nowdate)
                                                        {
                                                            $id=$result->isbn;
                                                            $rstatus=0;
                                                            $studentids=$_SESSION['slogin'];
                                                                $sql="update book set rstatus=:rstatus where isbn=:id";
                                                                $query = $dbh->prepare($sql);
                                                                $query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
                                                                $query->bindParam(':id',$id,PDO::PARAM_STR);
                                                                $query->execute();


                                                        $sql = "delete from bookreserve WHERE studentid=:studentids and bookisbn=:id";
                                                        $query = $dbh->prepare($sql);
                                                        $query -> bindParam(':studentids',$studentids, PDO::PARAM_STR);
                                                        $query -> bindParam(':id',$id, PDO::PARAM_STR);
                                                        $query -> execute();

                                                            ?>
                                                              <td class="center">
                                                       <a href="viewbook.php?bookid=<?php echo htmlentities($result->isbn);?>" onclick="return confirm('Are you sure you want to reserve the book <?php echo $result->bookname ?> ?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Reserve</button>
                                                       </td>

                                                <?php

                                                        }
                                                        else{
                                                    ?>

                                                    <td class="center">

                                             
                                               <a href="viewbook.php?bookcid=<?php echo htmlentities($result->isbn);?>" onclick="return confirm('Are you sure you want to cancel reservation for <?php echo $result->bookname ?>?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Cancel reservation</button>
                                               </td>
                                                <?php

                                                
}

                                                }
                                                 else
                                                {
                                                   ?><td class="center"><?php echo htmlentities("Book already reserved");?></td><?php 
                                                }
                                              
                                            }

                                            else{

                                            
?>
                                               <td class="center">
                                               <a href="viewbook.php?bookid=<?php echo htmlentities($result->isbn);?>" onclick="return confirm('Are you sure you want to reserve the book <?php echo $result->bookname ?> ?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Reserve</button>
                                               </td>

                                                <?php
                                            }

                                            }
                                          ?>


                                          



                                            
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                                <?
                                }
                                else
                                    {?>


                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>ISBN</th>
                                            <th>Published Date</th>
                                            <th>Book added Date</th>
                                            <th> Status</th>
                                            <th>Reserve book</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $sql = "SELECT book.bookname,category.categoryname,author.authorname,book.isbn,book.bookpublish,book.bookadd,book.status,book.rstatus,book.bookid as bookid from book join author on author.authorid=book.authid join category on category.categoryid=book.catid";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>                                      
                                            <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookname);?></td>
                                            <td class="center"><?php echo htmlentities($result->authorname);?></td>
                                            <td class="center"><?php echo htmlentities($result->categoryname);?></td>
                                            <td class="center"><?php echo htmlentities($result->isbn);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookpublish);?></td>
                                            <td class="center"><?php echo htmlentities($result->bookadd);?></td><?php
                                            if($result->status==1)
                                            {
                                                $status="Not available in library";
                                                $message="Book is not available for reserve"
                                               ?> <td class="center"><?php echo htmlentities($status);?></td>

                                                  <td class="center"><?php echo htmlentities($message);?></td>

                                               <?php

                                            }
                                            else
                                            {
                                                $status="Available";
                                                ?><td class="center"><?php echo htmlentities($status);?></td>




                                                <?php
                                                if($result->rstatus==1)
                                            {

                                                $checkid=$_SESSION['slogin'];
                                                $sql="SELECT * FROM bookreserve where studentid=$checkid and bookisbn=$result->isbn";

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
                                                        else {

                                                            ?>
                                                              <td class="center">
                                                       <a href="viewbook.php?bookid=<?php echo htmlentities($result->isbn);?>" onclick="return confirm('Are you sure you want to reserve the book <?php echo $result->bookname ?>?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Reserve</button>
                                                       </td><?php } ?>

                                                <?php

                                                        }
                                                        else{
                                                    ?>

                                                    <td class="center">

                                             
                                               <a href="viewbook.php?bookcid=<?php echo htmlentities($result->isbn);?>" onclick="return confirm('Are you sure you want to cancel your reservation for <?php echo $result->bookname ?>');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Cancel reservation</button>
                                               </td>
                                                <?php

                                                
                                                }

                                                }


                                                else
                                                {
                                                   ?><td class="center"><?php echo htmlentities("Book already reserved");?></td><?php 
                                                }
                                              

                                            }
                                            else{

                                            
?>      
                                                  <td class="center">
                                                
                                                <a href="viewbook.php?bookid=<?php echo htmlentities($result->isbn);?>" onclick="return confirm('Are you sure you want to reserve the book <?php echo $result->bookname ?> ?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Reserve book</button>
                                                    </td>
                                                <?php
                                            }

                                            }
                                          ?>


                                          



                                            
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
<?}?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
 <?php
     if(isset($_GET['bookid']))
{

    $bookisbn=$_GET['bookid'];
    $studentid=$_SESSION['slogin'];
    $reserved= date('Y-m-d G:i:s');


    $due= date('Y-m-d', strtotime($reserved. ' + 2 days'));
    
   $sqlr="INSERT INTO bookreserve(reserveid,studentid,bookisbn,reserved,due) VALUES('',:studentid,:bookisbn,:reserved,:due)"; 

$query = $dbh->prepare($sqlr);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':bookisbn',$bookisbn,PDO::PARAM_STR);
$query->bindParam(':reserved',$reserved,PDO::PARAM_STR);
$query->bindParam(':due',$due,PDO::PARAM_STR);
if($query->execute())
{

   
        $rstatus=1;
        $sql="update book set rstatus=:rstatus where isbn=:bookisbn";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
        $query->bindParam(':bookisbn',$bookisbn,PDO::PARAM_STR);
        $query->execute();


?>
   <script type="text/javascript">
    alert("Book reserve request successful. Please come to the library within 2 days to issue the book");
    window.location="viewbook.php";
   </script>
    <?php
}
else 
{ 
?>
   <script type="text/javascript">
    alert("Book reserve request fail");
        window.location="viewbook.php";
   </script>
    <?php
}



}
?>

 <?php
     if(isset($_GET['bookcid']))
{
        $id=$_GET['bookcid'];
        $studentids=$_SESSION['slogin'];

        $rstatus=0;
        $sql="update book set rstatus=:rstatus where isbn=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
        $query->bindParam(':id',$id,PDO::PARAM_STR);
        $query->execute();


$sql = "delete from bookreserve WHERE studentid=:studentids and bookisbn=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':studentids',$studentids, PDO::PARAM_STR);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
 ?>
         <script type="text/javascript">
             alert("Book reservation canceled");
            window.location="viewbook.php"; 
        </script>
        <?
}?>


<?php
include("include/footer.php");
?>

       