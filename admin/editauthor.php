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
                        <h3>Author</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Edit Authorname</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form role="form" method="post">
                            <?php 
                            $authorid=intval($_GET['authid']);
                            $sql="SELECT * from author where authorid=:authorid";
                            $query=$dbh->prepare($sql);
                            $query-> bindParam(':authorid',$authorid, PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {               
                              ?> 
                            <div class="form-group">
                            <label>Author Name</label>
                            <input class="form-control" type="text" name="author" value="<?php echo htmlentities($result->authorname);?>" required />
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
        $authorname=$_POST['author'];
        $authorid=$_GET['authid'];
        $sql="update author set authorname=:authorname where authorid=:authorid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':authorname',$authorname,PDO::PARAM_STR);
        $query->bindParam(':authorid',$authorid,PDO::PARAM_STR);
        if( $query->execute())
        {
             ?>
         <script type="text/javascript">
            alert("Author edited successfully");
            window.location="viewauthor.php"; 
        </script>
        <?
        }
       }

        ?>




<?php
include("include/footer.php");
?>
