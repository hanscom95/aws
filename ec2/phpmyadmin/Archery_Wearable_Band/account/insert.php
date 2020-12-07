<?php
$id = !empty($_REQUEST["_id"]) ? "".$_REQUEST["_id"]."" : "NULL";
$pw = $_REQUEST["pw"];
$name = $_REQUEST["name"];
$birth = $_REQUEST["birth"];
$email = $_REQUEST["email"];
$tall = !empty($_REQUEST["tall"]) ? "".$_REQUEST["tall"]."" : "0";
$weight = !empty($_REQUEST["weight"]) ? "".$_REQUEST["weight"]."" : "0";
$gender = !empty($_REQUEST["gender"]) ? "".$_REQUEST["gender"]."" : "0";
$age = !empty($_REQUEST["age"]) ? "".$_REQUEST["age"]."" : "0";
$deviceaddress = $_REQUEST["device_addr"];
$hand = !empty($_REQUEST["hand"]) ? "".$_REQUEST["hand"]."" : "0";
$nationality = $_REQUEST["nationality"];
$team = $_REQUEST["team"];
$ip = $_REQUEST["ip"];
$etc = $_REQUEST["etc"];


function unistr_to_xnstr($str){ 
    return preg_replace('/\\\u([a-z0-9]{4})/i', "&#x\\1;", $str); 
} 

$conn=mysqli_connect("localhost","root","zxcv123","archery");

if (mysqli_connect_errno()){
	$json = json_encode(array("result"=>"404", "msg"=>mysqli_connect_error($conn)));  
	echo unistr_to_xnstr($json);
}

mysqli_set_charset($conn, 'utf8');

$result = mysqli_query($conn,
"INSERT INTO `account` (`_id`, `pw`, `name`, `birth`, `email`, `tall`, `weight`, `gender`, `date`, `age`, `deviceaddress`, `hand`, `nationality`, `team`, `ip`, `etc`)
VALUES ('".$id."', password('".$pw."'), '".$name."', '".$birth."', '".$email."', '".$tall."', '".$weight."', '".$gender."', CURRENT_TIMESTAMP, '".$age."', '".$deviceaddress."', '".$hand."', '".$nationality."', '".$team."', '".$ip."', '".$etc."')");


if($result){ 
	$json = json_encode(array("result"=>"200", "msg"=>"OK"));  
	echo unistr_to_xnstr($json);
}
else {
	$json = json_encode(array("result"=>mysqli_errno($conn), "msg"=>mysqli_error($conn)));  
	echo unistr_to_xnstr($json);
}



mysqli_close($conn);
?>
