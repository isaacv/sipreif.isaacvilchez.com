<?php
/**
* filename: fire-prob.php
* description: this will return the probability of occurrence of a forest fire based on Temp, Hum and Smoke.
*
* Defining the probability of occurrence of a forest fire
* PARAMS:
* $smallfire = probability of a small localized fire only impacting 1 node
* $largefire = probability of a fire to affect more than 2 nodes
* $fireprob  = probability of a fire given the two previous params
* $temp      = temperature of node
* $hum       = Relative humidity in %
*/
//setting header to json
header('Content-Type: application/json');

$data = array();
$sensors = array();
$settemp = 100;

//mysqli_connect(host, username, password, dbname)
$link = @mysqli_connect("localhost", "root", "EvaMarielle19*", "sipreif") or die("ERROR: Unable to connect: " . mysqli_connect_error());

$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=111 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $crow1 = mysqli_fetch_array($result);
    $temp = $crow1[1];
    $prob1 = $temp/$settemp;
    //print_r("Sensor ID: ".$row1[0]." || Sensor Temp: ".$row1[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=211 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row2 = mysqli_fetch_array($result);
    $prob2 = ($row2[1])/$settemp;
    //print_r("Sensor ID: ".$row2[0]." || Sensor Temp: ".$row2[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=311 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row3 = mysqli_fetch_array($result);
    $prob3 = ($row3[1])/$settemp;
    //print_r("Sensor ID: ".$row3[0]." || Sensor Temp: ".$row3[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=112 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row4 = mysqli_fetch_array($result);
    $prob4 = ($row4[1])/$settemp;
    //print_r("Sensor ID: ".$row3[0]." || Sensor Temp: ".$row3[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=212 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row5 = mysqli_fetch_array($result);
    $prob5 = ($row5[1])/$settemp;
    //print_r("Sensor ID: ".$row3[0]." || Sensor Temp: ".$row3[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=312 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row6 = mysqli_fetch_array($result);
    $prob6 = ($row6[1])/$settemp;
    //print_r("Sensor ID: ".$row3[0]." || Sensor Temp: ".$row3[1]);
}
?>
