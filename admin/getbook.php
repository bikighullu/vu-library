<?php 
require_once("include/connect.php");
if(!empty($_POST["bookid"])) {
  $bookids=$_POST["bookid"];
 
    $sql ="SELECT bookname FROM book WHERE isbn=:bookids";
$query= $dbh -> prepare($sql);
$query-> bindParam(':bookids', $bookids, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
  foreach ($results as $result) {?>
<b>Book Name :</b> 
<?php  
echo htmlentities($result->bookname);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
 else{
  
  echo "<span style='color:red'> Invaid ISBN number. Please Enter Valid ISBN number .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
