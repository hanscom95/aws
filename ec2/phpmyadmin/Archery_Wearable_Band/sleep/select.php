<?php  
 
$id = $_REQUEST["_id"] ;
$type = $_REQUEST["type"] ;

function unistr_to_xnstr($str){ 
    return preg_replace('/\\\u([a-z0-9]{4})/i', "&#x\\1;", $str); 
} 
 
$conn=mysqli_connect("localhost","root","zxcv123","archery");
  
if (mysqli_connect_errno($conn))  
{  
	$json = json_encode(array("result"=>"404", "msg"=>mysqli_connect_error($conn)));  
	echo unistr_to_xnstr($json);
}  
 
 
mysqli_set_charset($conn,"utf8");  
 
if ($type == "0"){ //DAY
	$res = mysqli_query($conn,"SELECT * FROM `sleep` WHERE _id='".$id."' AND `date` BETWEEN DATE_ADD(NOW(),INTERVAL -1 DAY ) AND NOW()");  
}else if($type == "1"){ // WEEK
	$res = mysqli_query($conn,"SELECT * FROM `sleep` WHERE _id='".$id."' AND `date` BETWEEN DATE_ADD(NOW(),INTERVAL -1 WEEK ) AND NOW()");  
}else if($type == "2"){ // MONTH
	$res = mysqli_query($conn,"SELECT * FROM `sleep` WHERE _id='".$id."' AND `date` BETWEEN DATE_ADD(NOW(),INTERVAL -1 MONTH ) AND NOW()");  
}else if($type == "3"){ // YEAR
	$res = mysqli_query($conn,"SELECT * FROM `sleep` WHERE _id='".$id."' AND `date` BETWEEN DATE_ADD(NOW(),INTERVAL -1 YEAR ) AND NOW()");  
}

   
if(mysqli_num_rows($res) == 0) {
	$json = json_encode(array("result"=>"200", "msg"=>"No saved data."));  
	echo unistr_to_xnstr($json);
}
else if($res){ 
	$result = array();  


	while($row = mysqli_fetch_array($res)){  
	  array_push($result,  
		array('id'=>$row[1],'type'=>$row[2],'s_sleep'=>$row[3],'e_sleep'=>$row[4],'date'=>$row[5]
		));  
	}  
	   
	$json = json_encode(array("result"=>"200", "msg"=>"OK", "data"=>$result));  
	echo unistr_to_xnstr($json);
}else {
	$json = json_encode(array("result"=>mysqli_errno($conn), "msg"=>mysqli_error($conn)));  
	echo unistr_to_xnstr($json);
}
 
   
mysqli_close($conn);  
   
?>
