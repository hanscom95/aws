<?php  

header("Content-Type: text/html; charset=UTF-8");
 
$id = $_REQUEST["_id"] ;
$pw = $_REQUEST["pw"] ;

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
 
 
$res = mysqli_query($conn,"select * from account where _id='".$id."' and pw=password('".$pw."')");  
   
if(mysqli_num_rows($res) == 0) {
	$json = json_encode(array("result"=>"404", "msg"=>"The ID or password is incorrect."));  
	echo unistr_to_xnstr($json);
}
else if($res){ 
	$result = array();  

	while($row = mysqli_fetch_array($res)){  
	  array_push($result,  
		array('id'=>$row[0],'name'=>$row[2],'birth'=>$row[3],'email'=>$row[4],'tall'=>$row[5],'weight'=>$row[6],'gender'=>$row[7],'date'=>$row[8],'age'=>$row[9],'device_addr'=>$row[10],'hand'=>$row[11],'nationality'=>$row[12]  ,'team'=>$row[13]  ,'ip'=>$row[14]  ,'etc'=>$row[15]    
		));  
	}  	   
	 
	$json = json_encode(array("result"=>"200", "msg"=>"OK", "data"=>$result));  
	echo unistr_to_xnstr($json);
}
else {
	$json = json_encode(array("result"=>mysqli_errno($conn), "msg"=>mysqli_error($conn)));  
	echo unistr_to_xnstr($json);
}
 
   
mysqli_close($conn);  
   
?>
