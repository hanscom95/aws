<?php
$id = $_REQUEST["_id"];
$type = !empty($_REQUEST["type"]) ? "".$_REQUEST["type"]."" : "0";
$s_sleep = !empty($_REQUEST["s_sleep"]) ? "".$_REQUEST["s_sleep"]."" : "00:00:00";
$e_sleep = !empty($_REQUEST["e_sleep"]) ? "".$_REQUEST["e_sleep"]."" : "00:00:00";
$date = !empty($_REQUEST["date"]) ? "".$_REQUEST["date"]."" : "2017-01-01";

function unistr_to_xnstr($str){ 
    return preg_replace('/\\\u([a-z0-9]{4})/i', "&#x\\1;", $str); 
} 

$conn=mysqli_connect("localhost","root","zxcv123","archery");

if (mysqli_connect_errno()){
	$json = json_encode(array("result"=>"404", "msg"=>mysqli_connect_error($conn)));  
	echo unistr_to_xnstr($json);
}

$result = mysqli_query($conn,
"INSERT INTO `sleep` (`col`, `_id`, `type`, `s_sleep`, `e_sleep`, `date`) 
VALUES ((SELECT CONCAT('".$id."_',COUNT(_id)+1) FROM (select * from sleep) AS A WHERE _id = '".$id."'), '".$id."', '".$type."', '".$s_sleep."', '".$e_sleep."', '".$date."')");

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
