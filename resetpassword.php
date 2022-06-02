<?php

include_once("config.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
//mettre les donnnes et rediriger lutilsiateur vers le loginresetpassword

 if(isset($_GET['token'])  && !empty($_GET['token']) )
{
   $token=mysqli_escape_string($mysqli,$_GET['token']);
   // $email=mysqli_escape_string($mysqli,$_GET['email']);
  
    $updatedata="update passwordreset set status=1 WHERE token='$token' ";
    
    $search=mysqli_query($mysqli,"SELECT  token , status FROM passwordreset where token='$token' and status='0' ")or die(mysql_error());
    $match =mysqli_num_rows($search);
    if($match>0)
    {
        $sql= mysqli_query($mysqli,$updatedata);
        if($sql){
            
            $msg= '<div  color="green" class="data"><p style="color:blue">you will be redirect to reset password dashboard</p></div>';
             sleep(2);
             header ('Location:http://localhost:4200/loginresetpassword');
 
             mysqli_query($mysqli,"delete FROM passwordreset where token='$token' and status='1' ");
             
           
        }else {
            $msg='<div class="data">Invalid approach, please use the link that has been send to your email.</div>';
            }

    }else{
        
            $msg='<div class="data"><p style="color:red">The url is either invalid or your have been already reset your account .</p></div>';
    }


}
?>
<?php echo $msg; ?>
