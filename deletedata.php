<?php
include_once("config.php");
    //pour supprimer un utilisateur par son ID
 
if($_GET["empid"] !="")
{
 
$empid=$_GET["empid"];


  
  $sql = "delete from Users  WHERE Id = '{$empid}' LIMIT 1";
  
  
    //$query1 ="SET @autoid :=0 ;";
    //$query2 ="UPDATE Users SET Id = @autoid:=(@autoid+1);";
    //$query3 ="ALTER TABLE Users AUTO_INCREMENT=1;";
    
 
  if(mysqli_query($mysqli, $sql))
  {
    
     //mysqli_query($mysqli,  $query1 );
     //mysqli_query($mysqli,  $query2 );
     //mysqli_query($mysqli,  $query3 );
    
   http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}
?>
