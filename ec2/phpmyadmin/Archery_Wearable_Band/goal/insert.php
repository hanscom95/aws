<?php
$id = $_REQUEST["_id"];
$motion = !empty($_REQUEST["motion"]) ? "".$_REQUEST["motion"]."" : "0";
$goal = $_REQUEST["goal"];
$kcal = !empty($_REQUEST["kcal"]) ? "".$_REQUEST["kcal"]."" : "0";

function unistr_to_xnstr($str){ 
    return preg_replace('/\\\u([a-z0-9]{4})/i', "&#x\\1;", $str); 
} 

$conn=mysqli_connect("localhost","root","zxcv123","archery");

if (mysqli_connect_errno()){
	$json = json_encode(array("result"=>"404", "msg"=>mysqli_connect_error($conn)));  
	echo unistr_to_xnstr($json);
}

$result = mysqli_query($conn,
"INSERT INTO `goals` (`col`, `_id`, `motion`, `goal`, `kcal`) 
VALUES ((SELECT CONCAT('".$id."_',COUNT(_id)+1) FROM (select * from goals) AS A WHERE _id = '".$id."'), '".$id."', '".$motion."', '".$goal."', '".$kcal."')");



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
