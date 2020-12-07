<?php
$id = $_REQUEST["_id"];
$motion = !empty($_REQUEST["motion"]) ? "".$_REQUEST["motion"]."" : "0";
$count = !empty($_REQUEST["count"]) ? "".$_REQUEST["count"]."" : "0";
$kcal = !empty($_REQUEST["kcal"]) ? "".$_REQUEST["kcal"]."" : "0";
$time = !empty($_REQUEST["time"]) ? "".$_REQUEST["time"]."" : "00:00:00";
$date = !empty($_REQUEST["date"]) ? "".$_REQUEST["date"]."" : "2017-01-01";
$duration = !empty($_REQUEST["duration"]) ? "".$_REQUEST["duration"]."" : "00:00";

function unistr_to_xnstr($str){ 
    return preg_replace('/\\\u([a-z0-9]{4})/i', "&#x\\1;", $str); 
} 

$conn=mysqli_connect("localhost","root","zxcv123","archery");

if (mysqli_connect_errno()){
	$json = json_encode(array("result"=>"404", "msg"=>mysqli_connect_error($conn)));  
	echo unistr_to_xnstr($json);
}

$result = mysqli_query($conn,
"INSERT INTO `fitness` (`col`, `_id`, `motion`, `count`, `kcal`, `time`, `date`) 
VALUES ((SELECT CONCAT('".$id."_',COUNT(_id)+1) FROM (select * from fitness) AS A WHERE _id = '".$id."'), '".$id."', '".$motion."', '".$count."', '".$kcal."', '".$time."', '".$date."', '".$duration."')");


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
