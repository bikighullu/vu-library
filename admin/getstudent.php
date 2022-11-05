<?php 
require_once("include/connect.php");
if(!empty($_POST["studentid"])) {
  $studentids= $_POST["studentid"];
 
    $sql ="SELECT firstname,lastname,status FROM Student WHERE studentid=:studentids";
$query= $dbh -> prepare($sql);
$query-> bindParam(':studentids', $studentids, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->status==0)
{
echo "<span style='color:red'> Student ID Blocked </span>"."<br />";
echo "<b>Student Name-</b>" .$result->firstname;
echo "<b> </b>" .$result->lastname;
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
?>
<?php  
echo "<b>Student Name-</b>" .$result->firstname;
echo "<b> </b>" .$result->lastname;
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Invaid Student Id. Please Enter Valid Student id .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}

}



?>
