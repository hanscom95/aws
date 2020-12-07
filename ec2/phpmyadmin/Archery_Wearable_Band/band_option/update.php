<?php
$id = $_REQUEST["_id"];
$ota = !empty($_REQUEST["ota"]) ? "".$_REQUEST["ota"]."" : "0";
$video = $_REQUEST["video"];
$acc_date = !empty($_REQUEST["acc_date"]) ? "".$_REQUEST["acc_date"]."" : date('Y-m-d');
$date = !empty($_REQUEST["date"]) ? "".$_REQUEST["date"]."" : date('Y-m-d');

function unistr_to_xnstr($str){ 
    return preg_replace('/\\\u([a-z0-9]{4})/i', "&#x\\1;", $str); 
} 

$conn=mysqli_connect("localhost","root","zxcv123","archery");

if (mysqli_connect_errno()){
	$json = json_encode(array("result"=>"404", "msg"=>mysqli_connect_error($conn)));  
	echo unistr_to_xnstr($json);
}

$result = mysqli_query($conn, 
"UPDATE `se_option` SET `ota_version`='".$ota."',`fit_video`='".$video."',`account_date`='".$acc_date."',`date`='".$date."' WHERE `_id` = '".$id."'");



if($result) {
	$json = json_encode(array("result"=>"200", "msg"=>"OK"));  
	echo unistr_to_xnstr($json);
}
else {
	$json = json_encode(array("result"=>mysqli_errno($conn), "msg"=>mysqli_error($conn)));  
	echo unistr_to_xnstr($json);
}



mysqli_close($conn);
?>