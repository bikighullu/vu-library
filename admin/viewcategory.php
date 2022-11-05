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
                        <h3>Categories</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>List of Categories</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                           
                                            <th>Creation Date</th>
                                            <th> Edit/Delete</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sql = "SELECT * from  category";
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
                                            <td class="center"><?php echo htmlentities($result->categoryname);?></td>
                                            <td class="center"><?php echo htmlentities($result->categorydate);?></td>
                                            <td class="center">

                                            <a href="editcategory.php?catid=<?php echo htmlentities($result->categoryid);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 
                                          <a href="viewcategory.php?del=<?php echo htmlentities($result->categoryid);?>" onclick="return confirm('Are you sure you want to delete <?php echo $result->categoryname?> ? ');"" >  <button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button>
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
        if(isset($_GET['del']))
        {

        $id=$_GET['del'];


            $sql="SELECT * from book where catid=$id";
          
                $query = $dbh -> prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount() > 0)
                {?>
                    <script type="text/javascript">
                    alert("Category cannot be deleted because there are books under this category");
                    </script>
                <?php
            }
                else
                {
                $sql = "delete from category  WHERE categoryid=:categoryid";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':categoryid',$id, PDO::PARAM_STR);
                $query -> execute();
                ?>
                 <script type="text/javascript">
                    window.location="viewcategory.php"; 
                </script>
                <?
                }


        }
        ?>
<?php
include("include/footer.php");
?>

       