<?php
/**
 * filename: .php
 * description: this will return the score of the teams.
 */

//setting header to json
header('Content-Type: application/json');

$data = array();
$sensors = array();
$sensorid;
$now = time();
$timewarn = 1800000;

//mysqli_connect(host, username, password, dbname)
$link = @mysqli_connect("localhost", "root", "EvaMarielle19*", "sipreif") or die("ERROR: Unable to connect: " . mysqli_connect_error());

$getsensorid= "SELECT id FROM varBoscosas GROUP BY id;";
if($result = mysqli_query($link, $getsensorid)){
    foreach ($result as $row) {
      array_push($sensors, $row);
    }
}

$count = count($sensors);
for ($i = 0; $i < $count; $i++) {
    $sensorid = $sensors[$i]['id'];
    $sql= "SELECT unix FROM varBoscosas WHERE id=".$sensorid." ORDER BY unix DESC LIMIT 1;";
    if($result = mysqli_query($link, $sql)){
        foreach ($result as $row) {
          array_push($data, $row);
        }
    }
}

$count = count($data);
for ($i = 0; $i < $count; $i++) {
    $lastreport = $data[$i]['unix'];
    $lastreport = (int)$lastreport;
    $timediff = $now-$lastreport;
    $data[$i]['time_diff'] = $timediff;
    
    if ($timediff > $timewarn){
        // Validate the tempVar
        $alerttype=1007;
        $alertMsg = '<p>The Node ID: '.$sensorid.' IS NOT ONLINE. The last time this sensor reported a status update was: '.$lastreport.'</p>';
        $data[$i]['sensor_off_alert']=$alertMsg;
        
        // Send email function
        //mail($to_mail, $subject,$alertMsg,$headers);

        // Insert Alert into Log
        $insertSql = 'INSERT INTO sensoralerts (typeid,sensorid,alertmsg) VALUES ('.$alerttype.','.$sensorid.',"'.$alertMsg.'");';
        $result = mysqli_query($link, $insertSql) or die (mysqli_error($link));
        $data[$i]['sensor_off']= $result;
    } else {
        $data[$i]['sensor_off']= false;
    }
}

$data['now']= $now;

//now print the data
print json_encode($data);
?>