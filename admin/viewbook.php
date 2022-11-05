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
                        <h3>Books</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>List of Books</h2>

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
                                    <option value="bookname">Book Name</option>
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
                                            <th>Status</th>
                                            <th>Action</th>
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


                                    $sql = "SELECT book.bookname,category.categoryname,author.authorname,book.isbn,book.bookpublish,book.bookadd,book.status,book.bookid as bookid from book join author on author.authorid=book.authid join category on category.categoryid=book.catid  WHERE $head.$search1 like('%$search%')";
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
                                            <td class="center"><?php echo htmlentities($result->bookadd);?></td>
                                            <?php
                                            if($result->status==1)
                                            {
                                                $status="Not available";
                                               ?> <td class="center"><?php echo htmlentities($status);?></td><?php

                                            }
                                            else
                                            {
                                                $status="Available";
                                                ?><td class="center"><?php echo htmlentities($status);?></td><?php
                                            }
                                          ?>
                                            <td class="center">

                                            <a href="editbook.php?bookid=<?php echo htmlentities($result->bookid);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 
                                          <a href="viewbook.php?del=<?php echo htmlentities($result->isbn);?>" onclick="return confirm('Are you sure you want to delete <?php echo $result->bookname ?> ?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
                                            </td>
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
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                          $sql = "SELECT book.bookname,category.categoryname,author.authorname,book.isbn,book.bookpublish,book.bookadd,book.status,book.bookid as bookid from book join author on author.authorid=book.authid join category on category.categoryid=book.catid";
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
                                            <td class="center"><?php echo htmlentities($result->bookadd);?></td>
                                            <?php
                                            if($result->status==1)
                                            {
                                                $status="Not available";
                                               ?> <td class="center"><?php echo htmlentities($status);?></td><?php

                                            }
                                            else
                                            {
                                                $status="Available";
                                                ?><td class="center"><?php echo htmlentities($status);?></td><?php
                                            }
                                          ?>
                                            <td class="center">

                                            <a href="editbook.php?bookid=<?php echo htmlentities($result->bookid);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 
                                          <a href="viewbook.php?del=<?php echo htmlentities($result->isbn);?>" onclick="return confirm('Are you sure you want to delete  <?php echo $result->bookname ?> ?');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
                                            </td>
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
     if(isset($_GET['del']))
{
$id=$_GET['del'];

 $sql="SELECT * from bookissue where bookid=$id and returnstatus=0";          
                $query = $dbh -> prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount() > 0)
                {
                ?>
                    <script type="text/javascript">
                    alert("Book can not be deleted because the book is issued to student.");
                    </script>
                <?php
                }
                else
                {
$sql = "delete from book  WHERE isbn=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
 ?>
         <script type="text/javascript">
            window.location="viewbook.php"; 
        </script>
        <? 
    }
}?>



<?php
include("include/footer.php");
?>

       