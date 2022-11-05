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
if(isset($_POST['issue']))
{
$studentid=$_POST['studentid'];
$bookid=$_POST['bookid'];
$bookissued= date('Y-m-d G:i:s');
$exissue= date('Y-m-d', strtotime($bookissued. ' + 14 days'));





                                    $get = "SELECT status from book where isbn=$bookid";
                                    $query = $dbh -> prepare($get);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {   

                                        if($result->status==1)
                                        {
                                            ?>

                                              <script type="text/javascript">
                                            alert("Book is already issued by someother student");
                                            window.location="issuebook.php"; 
                                             </script>
                                             <?php
                                        }
                                    else
                                    {
                                
$sql="INSERT INTO bookissue(bookid,studentid,bookissued,exissue) VALUES(:bookid,:studentid,:bookissued,:exissue)";

$query = $dbh->prepare($sql);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':bookissued',$bookissued,PDO::PARAM_STR);
$query->bindParam(':exissue',$exissue,PDO::PARAM_STR);
if($query->execute())
{
    

        $usql="update book set status=1 where isbn=$bookid";
        $querys = $dbh->prepare($usql);
        $querys->execute();
?>
   <script type="text/javascript">
    alert("Books issue succesfull");
   </script>
    <?php
}
else 
{
?>
   <script type="text/javascript">
    alert("Books issue fail");
   </script>
    <?php
}
}

}
}

}
?>

        <script>
        function getstudent() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "getstudent.php",
        data:'studentid='+$("#studentid").val(),
        type: "POST",
        success:function(data){
        $("#get_student_name").html(data);
        $("#loaderIcon").hide();
        },
        error:function (){}
        });
        }

        
        function getbook() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "getbook.php",
        data:'bookid='+$("#bookid").val(),
        type: "POST",
        success:function(data){
        $("#get_book_name").html(data);
        $("#loaderIcon").hide();
        },
        error:function (){}
        });
        }

        </script> 

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Book Issue</h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Enter student id and ISBN number</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                               <form role="form" method="post">

                                    <div class="form-group">
                                    <label>Student ID<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off"  required />
                                    </div>

                                    <div class="form-group">
                                    <span id="get_student_name" style="font-size:16px;"></span> 
                                    </div>


                                    <div class="form-group">
                                    <label>ISBN Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookid" id="bookid" onBlur="getbook()" autocomplete="off" required/>
                                    </div>

                                     <div class="form-group">

                                      <span id="get_book_name" style="font-size:16px"></span>
                                       
                                   
                                     </div>
                                    <button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>

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