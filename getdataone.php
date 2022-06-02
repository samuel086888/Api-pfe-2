<?php
include_once("config.php");
 
$postdata = file_get_contents("php://input");
$empid=$_GET["empid"];
 
$sql="SELECT Id,name,email,pwd , Authorization FROM Users where Id='$empid'";
       
//recuperer une données par son id
 
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