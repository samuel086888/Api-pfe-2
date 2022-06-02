<!DOCTYPE>
  
<html >
<head>
    <title>Account verification > Sign up</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <!-- start header div --> 
    <div id="header">
        <h3>confirmation mail > Sign up</h3>
    </div>
    <!-- end header div -->   
      
    <!-- start wrap div -->   
    <div id="wrap">
        <!-- start PHP code -->

<?php

            //verifier le compte apres creaction
        
            include_once("config.php");
            $postdata = file_get_contents("php://input");
             $request = json_decode($postdata);

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token']))
{
    $email=mysqli_escape_string($mysqli,$_GET['email']);
    $token=mysqli_escape_string($mysqli,$_GET['token']);
    $search=mysqli_query($mysqli,"SELECT email , status,token FROM Users Where email='"$email"' AND token='"$token"' AND status='inactif'") or die(mysql_error());
    $match =mysqli_num_rows($search);
       if($match>0)
       {  //We have a macth , activate the account
           mysqli_query("UPDATE Users SET token='1' WHERE email='"$email"' AND token='"$token"' AND token='0'") or die(mysql_error());
          $msg= '<div class="data">Your account has been activated, you can now login</div>';

       }
       else{
           //no match
           $msg='<div class="data">The url is either invalid or you already have activated your account.</div>';
       }
       
  } else {  
     $msg='"<div class="data">Invalid approach, please use the link that has been send to your email.</div>"';
}


?>
   <!-- stop PHP Code -->
  
   <?php echo $msg; ?>
   </div>
    <!-- end wrap div --> 
</body>
</html>