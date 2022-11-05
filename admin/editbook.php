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
                        <h3>Book</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Edit Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                               

                                <form role="form" method="post">
                                    <?php 
                                    $bookid=$_GET['bookid'];
                                    $sql = "SELECT book.bookname,category.categoryname,category.categoryid,author.authorname,author.authorid,book.isbn,book.bookpublish,book.bookadd,book.bookid as bookid from  book join author on author.authorid=book.authid join category on category.categoryid=book.catid where bookid='$bookid'";
                                    $query = $dbh -> prepare($sql);
                                    $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>  

                                    <div class="form-group">
                                    <label>Book Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->bookname);?>" required />
                                    </div>

                                    


                                     <div class="form-group">
                                    <label> Author name<span style="color:red;">*</span></label>
                                    <select class="form-control" name="author" required="required">
                                    <option value="<?php echo htmlentities($result->authorid);?>"> <?php echo htmlentities($authorname=$result->authorname);?></option>
                                    <?php 
                                    $status=1;
                                    $sql1 = "SELECT * from author";
                                    $query1 = $dbh -> prepare($sql1);
                                    $query1->execute();
                                    $resultss=$query1->fetchAll(PDO::FETCH_OBJ);
                                    if($query1->rowCount() > 0)
                                    {
                                    foreach($resultss as $row)
                                    {           
                                    if($authorname==$row->authorname)
                                    {
                                    continue;
                                    }
                                    else
                                    {
                                        ?>  
                                    <option value="<?php echo htmlentities($row->authorid);?>"><?php echo htmlentities($row->authorname);?></option>
                                     <?php }}} ?> 
                                    </select>
                                    </div>

                                    <div class="form-group">
                                    <label> Category<span style="color:red;">*</span></label>
                                    <select class="form-control" name="category" required="required">
                                    <option value="<?php echo htmlentities($result->categoryid);?>"> <?php echo htmlentities($categoryname=$result->categoryname);?></option>
                                    <?php 
                                    $status=1;
                                    $sql1 = "SELECT * from  category";
                                    $query1 = $dbh -> prepare($sql1);
                                    $query1->execute();
                                    $resultss=$query1->fetchAll(PDO::FETCH_OBJ);
                                    if($query1->rowCount() > 0)
                                    {
                                    foreach($resultss as $row)
                                    {           
                                    if($categoryname==$row->categoryname)
                                    {
                                    continue;
                                    }
                                    else
                                    {
                                        ?>  
                                    <option value="<?php echo htmlentities($row->categoryid);?>"><?php echo htmlentities($row->categoryname);?></option>
                                     <?php }}} ?> 
                                    </select>
                                    </div>
                                    <div class="form-group">
                                    <label>ISBN Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->isbn);?>"  required="required" />
                                    </div>

                                     <div class="form-group">
                                     <label>Published date<span style="color:red;">*</span></label>
                                     <input class="form-control" type="text" name="published" value="<?php echo htmlentities($result->bookpublish);?>"   required="required" />
                                     </div>
                                     <?php }} ?>
                                    <button type="submit" name="update" class="btn btn-info">Update </button>

                                    </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
             if(isset($_POST['update']))
        {
        $bookname=$_POST['bookname'];
        $bookid=$_GET['bookid'];
        $author=$_POST['author'];
        $category=$_POST['category'];
        $isbn=$_POST['isbn'];
        $published=$_POST['published'];
        $sql="update book set bookname=:bookname,authid=:author,catid=:category,isbn=:isbn,bookpublish=:published where bookid=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
        $query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
         $query->bindParam(':author',$author,PDO::PARAM_STR);
          $query->bindParam(':category',$category,PDO::PARAM_STR);
          $query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
           $query->bindParam(':published',$published,PDO::PARAM_STR);
        if( $query->execute())
        {
             ?>
         <script type="text/javascript">
            alert("Book edited successfully");
            window.location="viewbook.php"; 
        </script>
        <?
        }
       }

        ?>
       
<?php
include("include/footer.php");
?>

       