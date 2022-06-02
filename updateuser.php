<?php
include_once("config.php");
$postdata = file_get_contents("php://input");
 
//mettre a jour authorisation et telechargement d'un users par son id

$request = json_decode($postdata);
if(isset($postdata) && !empty($postdata))
{
   
	$id = mysqli_real_escape_string($mysqli, trim($request->id));
	
  $name = mysqli_real_escape_string($mysqli, trim($request->name));
  $pwd = mysqli_real_escape_string($mysqli, (int)$request->pwd);
   $email = mysqli_real_escape_string($mysqli, trim($request->email));

  $Authorization = mysqli_real_escape_string($mysqli, (int)$request->Authorization);
  $Telechargement= mysqli_real_escape_string($mysqli, (int)$request->Telechargement);
 
  $sql = "update Users set Authorization = $Authorization , Telechargement = $Telechargement where Id=$id ";

if ($mysqli->query($sql) === TRUE) {
 
 
    $authdata = [
      'name' => $name,
	  'pwd' => '',
	  'email' => $email,
     
      'Authorization'=>$Authorization,
      'Telechargement'=>$Telechargement,
      'Id'    => ''
    ];
    echo json_encode($authdata);
 
}
}
?>
