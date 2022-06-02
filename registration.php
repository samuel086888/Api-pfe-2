

<?php

require '/usr/share/php/libphp-phpmailer/src/PHPMailer.php';  //declaration du bibliotheque pour envoyer de mail sur linux (phpMailer)

require '/usr/share/php/libphp-phpmailer/src/SMTP.php';  //declaration du bibliotheque pour envoyer de mail sur linux (phpMailer)

include_once("config.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if(isset($postdata) && !empty($postdata))
{
  $token = bin2hex(random_bytes(100));
  $name = mysqli_real_escape_string($mysqli, trim($request->name));
  $pwd = mysqli_real_escape_string($mysqli,  trim($request->pwd));
  $email = mysqli_real_escape_string($mysqli, trim($request->email));




 $sql = "INSERT INTO Users(name,pwd,email,token) VALUES ('{$name}','{$pwd}','{$email}','{$token}')";

 // notez que sur windows le service pour envoyer le mail en localhost est sendmail.exe et il est automatiquement intégre a xampp sur os windows
 //si en localhost linux xampp (lampp)  n'est pas intégré par le service sendmail donc il faut passer par une bibliotheque phpMailer
 //installation  avec la commande suivante : apt-get install libphp-phpmailer
           
                 //declaration du service sendmail sur windows
 
//  $to = $email;
//  $subject = "Signup  | Verification";
//  $txt = "Thanks you $name for signing up!
//  Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

//  ------------------------
//  Username: $name
//  Email: $email
//  ------------------------

//  Please click this link to activate your account:
//           http://localhost/Api/activate.php?token=$token";
//  $headers = "From:no-reply <php.test.sendmail.086888@gmail>" . "\r\n" .
//  "CC:sign in Confirmation <php.test.sendmail.086888@gmail.com>";

//  mail($to,$subject,$txt,$headers);

   // fin du service sendmail windows

//Declare the object of PHPMailer pour linux

//Declare the object of PHPMailer

$Email = new PHPMailer\PHPMailer\PHPMailer();

//Mettre en place la configuration nécessaire pour envoyer un e-mail

$Email->IsSMTP();

$Email->SMTPAuth = true;

$Email->SMTPSecure = 'ssl';

$Email->Host = "smtp.gmail.com";

$Email->Port = 465;

// Définissez l'adresse gmail qui sera utilisée pour l'envoi de l'e-mail

$Email->Username = "php.test.sendmail.086888@gmail.com";

//Définir le mot de passe valide pour l'adresse gmail

$Email->Password = "!A1Y5wN8#VwMA227VR:94kjU:12=uS";

//Définir l'adresse e-mail de l'expéditeur

$Email->SetFrom("php.test.sendmail.086888@gmail.com","no-reply");

//Définir l'adresse e-mail du destinataire

$Email->AddAddress("$email");

// Définir le sujet

$Email->Subject = "Signup  | Verification";

//Définir le contenu de l'e-mail
 
$Email->Body = "merci de vous être inscription
Votre compte a été créé, vous pouvez vous connecter avec les informations d'identification suivantes après avoir activé votre compte en appuyant sur l'url ci-dessous.
-----------------------
   Username: $name
   Email: $email
   
------------------------
Veuillez cliquer sur ce lien pour activer votre compte : <br>
          http://localhost/Api/activate.php?token=$token";
   

$Email->IsHTML(true); 


$Email->Send();

 //fin phpmailer sur linux

if ($mysqli->query($sql) === TRUE) {


    $authdata = [
      'name' => $name,
	    'pwd' => $pwd,
	    'email' => $email,
      'token' =>$token,
      'Id'    => mysqli_insert_id($mysqli)
    ];
    echo json_encode($authdata);

}





}
?>
