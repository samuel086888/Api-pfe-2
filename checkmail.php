<?php
include_once("config.php");
 
$postdata = file_get_contents("php://input");
$Email=$_GET["Email"];
// verifier l'existance de mail d'un user
 
$sql="SELECT email FROM Users where email='$Email' ";
 
 
if($result = mysqli_query($mysqli,$sql))
{
 $rows = array();
  while($row = mysqli_fetch_assoc($result))
  {
    $rows[] = $row;
  }
 
  echo json_encode($rows);
}
else
{
  http_response_code(404);
}
?>