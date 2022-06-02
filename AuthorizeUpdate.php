<?php
include_once("config.php");         
$postdata = file_get_contents("php://input");
//pour mettre a jours authorization d'un user : 1 ou 0
 
$request = json_decode($postdata);
if(isset($postdata) && !empty($postdata))
{
 
	$id = mysqli_real_escape_string($mysqli, trim($request->id)); 

  $name = mysqli_real_escape_string($mysqli, trim($request->name));
  $pwd = mysqli_real_escape_string($mysqli, (int)$request->pwd);
   $email = mysqli_real_escape_string($mysqli, trim($request->email));

  $Authorization = mysqli_real_escape_string($mysqli, (int)$request->Authorization);
 
  $sql = "update Users set Authorization = $Authorization  where Id=$id "; //and email=$email

if ($mysqli->query($sql) === TRUE) {
 
 
    $authdata = [
      'name' => $name,
	  'pwd' => '',
	  'email' => $email,
      'Authorization' => $Authorization,
      'Id'    => ''
    ];
    echo json_encode($authdata);
 
}
}
?>