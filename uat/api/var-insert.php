<?php
include 'conndb.php';

$url=$_GET;
$sensorid= array(111,112,113,114,121,122,123,124,131,132,133,134,141,142,143,144,211,212,213,214,221,222,223,224,231,232,233,234,241,242,243,244,311,312,313,314,321,322,323,324,331,332,333,334,341,342,343,344,411,412,413,414,421,422,423,424,431,432,433,434,441,442,443,444);

var_dump($url);
                        echo "<br />";
$unix = time();
$id = $url[id];
$temp = $_GET[temp];
$hum = $_GET[hum];
$smokeVar = $_GET[smokeVar];
$lat = "19.16";
$lon = "71.05";
$tempFlag = $_GET[tempFlag];
$smokeFlag = $_GET[smokeFlag];
print_r("ID: ".$id);
                   
if (in_array($id, $sensorid)){
    $sql= "INSERT INTO varBoscosas (unix,id,temperature,humidity,smokeVar,latitude,longitude,tempFlag,smokeFlag) VALUES (".$unix.",".(int)$id.",".(float)$temp.",".(float)$hum.",".(float)$smokeVar.",".$lat.",".$lon.",".(int)$tempFlag.",".(int)$smokeFlag.");";
    print_r($sql);
    if(mysqli_query($link, $sql)){
        print_r("New row added successfully!");  
    }else{
        echo "ERROR: Unable to execute $sql";   
    }
}
?>
