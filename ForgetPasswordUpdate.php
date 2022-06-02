<?php
include_once("config.php");
$postdata = file_get_contents("php://input");
 
//mettre a jour le mot de passe par son mail
 
$request = json_decode($postdata);
if(isset($postdata) && !empty($postdata))
{
     p

   $pwd = mysqli_real_escape_string($mysqli, trim($request->pwd));
   $email = mysqli_real_escape_string($mysqli, trim($request->email));
 
  $sql = "update Users set pwd = '$pwd'  where email='$email' ";
  // mysqli_query($mysqli,"delete FROM passwordreset where email='$email' ");

if ($mysqli->query($sql) === TRUE) {
 
 
    $authdata = [
   
        // 'name' => $name,
        'pwd' => '',
        'email' => $email,
        // 'Authorization' => $Authorization,
        'Id'    => ''
    ];
    echo json_encode($authdata);
 
}
}
?>
