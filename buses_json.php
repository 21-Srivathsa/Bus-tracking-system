<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$con = mysql_connect("127.0.0.1","root","transpolinux");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
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
    elseif($direction==-1){
    	$query = "SELECT * from `busdata`";
    }   else
    {
        $query = "SELECT * from `busdata` where visibility=1";    
    }
    $result = mysql_query($query);
    #echo $result;	
    $response="[";
    $flag = true;
	while($row = mysql_fetch_array($result))
	{
        if($flag)
        {
            $flag = false;
            $response.="{ \"id\":\"".$row['id']."\",\"bus_name\":\"".$row['bus_name']."\",\"isMoving\":".$row['moving'].",\"lat\":".$row['lat'].",\"lng\":".$row['lng'].",\"routeid\":".$row['routeid'].",\"time\":\"".$row['last_time']."\"}";
        }
        else
        {
        $response.=",{ \"id\":\"".$row['id']."\",\"bus_name\":\"".$row['bus_name']."\",\"isMoving\":".$row['moving'].",\"lat\":".$row['lat'].",\"lng\":".$row['lng'].",\"routeid\":".$row['routeid'].",\"time\":\"".$row['last_time']."\"}";

	//$response.="#".$row['id'].",".$row['moving'].",".$row['lat'].",".$row['lng'].",".$row['routeid']".$row['last_time'];;
        }
	}
        $response.="]";
	echo $response;
}		
busdata((int)$_GET["direction"]);
mysql_close($con);
?>
