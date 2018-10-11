<?php ob_start();



$email_ontvanger = "matthijsschoneveld1976@gmail.com";
$onderwerp = "Bericht vanaf mijn site";

// bescherming tegen header injections:
$badStrings = array("Content-Type:",
                     "MIME-Version:",
                     "Content-Transfer-Encoding:",
                     "bcc:",
                     "cc:",
					 "<",
					 ">",
					 "[",
					 "]",);

// check alle ingevlde velden op foute tekens
foreach($_POST as $k => $v){
   foreach($badStrings as $v2){
       if(strpos($v, $v2) !== false){
          $error = "Er is/zijn code of tekens gebruikt die niet toegestaan zijn";
          
       }
   }
}   



//haal alle gegevens op die doorgestuurd worden vaniut het formulier
foreach($_POST as $key => $i) {
	//echo $key ."= ".$i."<br>";
	if($key <> "Verstuur") {
		$bericht .= $key ."= ".$i."<br>";
		
	}
}

$bericht = stripslashes("$bericht");
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if(!$error) {

$headers .= "From: $email_adres <$email_adres>";
	mail($email_ontvanger,$onderwerp, $bericht, $headers);
	
	//na het versturen tonen we de bedankt pagina aan de bezoeker
header("Location:".$_POST["redirect"]);

	
}else{
	echo $error;
}


?>
