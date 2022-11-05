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
        if(isset($_POST['add']))
        {
        $bookname=$_POST['bookname'];
        $authorname=$_POST['authorname'];
        $category=$_POST['category'];
        $isbn=$_POST['isbn'];
        $bookpublish=$_POST['bookpublish'];
        $bookadd= date('Y-m-d G:i:s');
        $sql="INSERT INTO book(bookid,bookname,authid,catid,isbn,bookpublish,bookadd,status) VALUES('',:bookname,:authorname,:category,:isbn,:bookpublish,:bookadd,0)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
        $query->bindParam(':authorname',$authorname,PDO::PARAM_STR);
        $query->bindParam(':category',$category,PDO::PARAM_STR);
        $query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
        $query->bindParam(':bookpublish',$bookpublish,PDO::PARAM_STR);
        $query->bindParam(':bookadd',$bookadd,PDO::PARAM_STR);
if($query->execute())
        {
       ?>
    <script type="text/javascript">
     alert("Books inserted succesfully");
     </script>
     <?php
        }
        else 
        {
          ?>
   <script type="text/javascript">
    alert("Books inserted failed");
   </script>
    <?php
        }

        }

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
                                <h2>Add books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                
                                        <form role="form" method="post">
                                        <div class="form-group">
                                        <label>Book Name<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="bookname" autocomplete="off"  required />
                                        </div>
                                    

                                        <div class="form-group">
                                        <label> Select Author<span style="color:red;">*</span></label>
                                        <select class="form-control" name="authorname" required="required">
                                        <option value=""> Select Author</option>
                                        <?php 
                                        $sql = "SELECT * from author";
                                        $query = $dbh -> prepare($sql);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $result)
                                        {               ?>  
                                        <option value="<?php echo htmlentities($result->authorid);?>"><?php echo htmlentities($result->authorname);?></option>
                                         <?php }} ?> 
                                        </select>
                                        </div>

                                        <div class="form-group">
                                        <label> Category<span style="color:red;">*</span></label>
                                        <select class="form-control" name="category" required="required">
                                        <option value=""> Select Category</option>
                                        <?php 
                                        //$status=1;
                                        $sql = "SELECT * from category";
                                        $query = $dbh -> prepare($sql);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        //$cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                        foreach($results as $result)
                                        {               ?>  
                                        <option value="<?php echo htmlentities($result->categoryid);?>"><?php echo htmlentities($result->categoryname);?></option>
                                         <?php }} ?> 
                                        </select>
                                        </div>

                                        <div class="form-group">
                                        <label>ISBN Number<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="isbn"  required="required" autocomplete="off"  />
                                        
                                        </div>

                                         <div class="form-group">
                                        <label>Published date<span style="color:red;">*</span></label>
                                        <input class="form-control" type="date" name="bookpublish"  required="required" autocomplete="off"  />
                                        
                                        </div>
                                        <button type="submit" name="add" class="btn btn-info">Add </button>

                                         </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

       
<?php
include("include/footer.php");
?>

       