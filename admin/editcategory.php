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
                        <h3>Category</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Edit Category</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form role="form" method="post">
                            <?php 
                            $categoryid=intval($_GET['catid']);
                            $sql="SELECT * from category where categoryid=:categoryid";
                            $query=$dbh->prepare($sql);
                            $query-> bindParam(':categoryid',$categoryid, PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {               
                              ?> 
                            <div class="form-group">
                            <label>Category Name</label>
                            <input class="form-control" type="text" name="category" value="<?php echo htmlentities($result->categoryname);?>" required />
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
        $categoryname=$_POST['category'];
        $categoryid=$_GET['catid'];
        $sql="update  category set categoryname=:categoryname where categoryid=:categoryid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':categoryname',$categoryname,PDO::PARAM_STR);
        $query->bindParam(':categoryid',$categoryid,PDO::PARAM_STR);
        if( $query->execute())
        {
             ?>
         <script type="text/javascript">
            alert("Category updated successfully");
            window.location="viewcategory.php"; 
        </script>
        <?
        }
       }

        ?>




<?php
include("include/footer.php");
?>
