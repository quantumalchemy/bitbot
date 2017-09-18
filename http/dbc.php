<?php
/* 
BITBOT ver 1.2 DeathByCaptcha API


// SECURITY - Only allow your ip to access this script
// collection of allowed IP addresses
$allowlist = array(
    '36.285.23.23',
    '12.101.67.56',
    '98.465.23.89',
    '16.289.90.10',
    '71.214.228.18'
);

//if users IP is not in allowed list kill the script
if(!in_array($_SERVER['REMOTE_ADDR'],$allowlist)){
    die('This website cannot be accessed from your location.');
}
*/


// ENTER YOUR DeathByCaptcha username/password BELOW:
$username = "username";
$password = "password";
// DO NOT CHANGE BELOW

if(isset($_GET["captcha_url"])){
	$captcha_url = $_GET["captcha_url"] ;
	
}else{
	echo "NF";
	exit;
}


require_once('deathbycaptcha.php');


try {
    $dbc = new DeathByCaptcha($username, $password);
    $balance = $dbc->getBalance();
    
    if($balance > 0){
        if($dbc->setCaptchaFromURL($captcha_url)){
            if($dbc->submitCaptcha()){
                echo $dbc->getCaptchaText() ;
            }else{
				echo "FAIL: submitCaptcha";
			}
        }
    }else{
		echo "FAIL: OUT OF FUNDS: Balance: $balance";
	}

} catch(Exception $ex) {
    echo "FAIL EXCEPTION: $ex";
}
?>
