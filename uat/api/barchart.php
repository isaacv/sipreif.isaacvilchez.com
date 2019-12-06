<?php
/**
 * filename: barchart.php
 * description: this will return the score of the teams.
 */

//setting header to json
header('Content-Type: application/json');

$data = array();
$sensors = array();

//mysqli_connect(host, username, password, dbname)
$link = @mysqli_connect("localhost", "root", "EvaMarielle19*", "sipreif") or die("ERROR: Unable to connect: " . mysqli_connect_error());

$getsensorid= "SELECT id FROM varBoscosas WHERE id IN (111,112,211,212,311,312) GROUP BY id;";
if($result = mysqli_query($link, $getsensorid)){
    foreach ($result as $row) {
      array_push($sensors, $row);
    }
}

$count = count($sensors);
for ($i = 0; $i < $count; $i++) {
    $sensorid = $sensors[$i]['id'];
    $sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id IN (".$sensorid.") ORDER BY id DESC LIMIT 1;";
    if($result = mysqli_query($link, $sql)){
        foreach ($result as $row) {
          array_push($data, $row);
        }
    }
}

//now print the data
print json_encode($data);

////free memory associated with result
//$result->close();
//
////close connection
//$mysqli->close();
?>
