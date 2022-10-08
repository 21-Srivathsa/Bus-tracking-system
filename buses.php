<?php

$con = mysql_connect("localhost","root","transpolinux");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
    print("Connected")
  }

mysql_select_db("insti", $con);


function busdata($direction){
    if($direction==10)
    {
        $query = "SELECT * from `busdata` where visibility=1";
    }
    elseif($direction==12){
        #echo "krishna";
    	$query = "SELECT * from `busdata` where `routeid`=12 and visibility=1";
    }
    elseif($direction==11){
    	$query = "SELECT * from `busdata` where `routeid`=11 and visibility=1";
    }
    else
    {
        $query = "SELECT * from `busdata` where visibility=1";    
    }
    $result = mysql_query($query);
    #echo $result;	
    $response="";
    $flag = true;
	while($row = mysql_fetch_array($result))
	{
        if($flag)
        {
            $flag = false;
            $response.=$row['id'].",".$row['moving'].",".$row['lat'].",".$row['lng'].",".$row['routeid'];
        }
        else
        {
	$response.="#".$row['id'].",".$row['moving'].",".$row['lat'].",".$row['lng'].",".$row['routeid'];
        }
	}
	echo $response;
}
busdata((int)$_GET["direction"]);
mysql_close($con);
?>
