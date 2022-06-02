<?php
include_once("config.php");
 
$sql = "SELECT * FROM Users";
//Id,name,email,pwd,Authorization
 
 //recuperer toute les donnees de la base
 
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
