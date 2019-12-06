<?php
/**
 * filename: alert-check.php
 * description: this will return the score of the teams.
 */

//setting header to json
header('Content-Type: application/json');

$data = array();
$sensors = array();

// Defining limits for alerts
$templim=105;
$humthreshold=10;
$smokethreshold=400;
$tempwarn=80;

// Alert Type
$alerttype=1001;

// Defining Mail Parameters
$to_mail = 'ivilchez@isaacvilchez.com';
$subject = '';
$alertMsg = '';
$headers = 'From: ivilchez@isaacvilchez.com' . "\r\n" .
    'Reply-To: ivilchez@isaacvilchez.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

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
    $sql= "SELECT * FROM varBoscosas WHERE id=".$sensorid." ORDER BY unix DESC LIMIT 1;";
    if($result = mysqli_query($link, $sql)){
        foreach ($result as $row) {
          array_push($data, $row);
        }
    }
}


// Validating Alerts
$count = count($data);
for ($i = 0; $i < $count; $i++) {
    // Global vars
    $sensorid = $data[$i]['id'];
    $temp = $data[$i]['temperature'];
    $hum = $data[$i]['humidity'];
    $smoke = $data[$i]['smokeVar'];
    $alerttype=1001;
    $subject = 'Sensor '.$sensorid.' is reporting High Temp Alert.';

// High temp alert (1001)
    if ($temp > $templim){

        // Validate the tempVar
        $alerttype=1001;
        $alertMsg = '<p>There is an alert due to High Temp.<br />- Alerting Node ID: '.$sensorid.'<br />- Registed Temperature: '.$temp.'</p>';
        $data[$i]['temp_alert']=$alertMsg;

        // Send email function
        //mail($to_mail, $subject,$alertMsg,$headers);
        echo "<script type='text/javascript'>alert('$alertMsg');</script>";

        // Insert Alert into Log
        $insertSql = 'INSERT INTO sensoralerts (typeid,sensorid,alertmsg) VALUES ('.$alerttype.','.$sensorid.',"'.$alertMsg.'");';
        $result = mysqli_query($link, $insertSql) or die (mysqli_error($link));
        $data[$i]['temp_alert_status']= $result;
    } else {
        $alertMsg = false;
        $data[$i]['temp_alert_status']= $alertMsg;
    }

// Low humidity alert (1002)
    if ($hum < $humthreshold){

        // Validate the tempVar
        $alerttype=1002;
        $alertMsg = '<p>There is an alert due to Low Humidity.<br />- Alerting Node ID: '.$sensorid.'<br />- Registed Humidity Level: '.$hum.'</p>';
        $data[$i]['hum_alert']=$alertMsg;

        // Send email function
        //mail($to_mail, $subject,$alertMsg,$headers);
        echo "<script type='text/javascript'>alert('$alertMsg');</script>";

        // Insert Alert into Log
        $insertSql = 'INSERT INTO sensoralerts (typeid,sensorid,alertmsg) VALUES ('.$alerttype.','.$sensorid.',"'.$alertMsg.'");';
        $result = mysqli_query($link, $insertSql) or die (mysqli_error($link));
        $data[$i]['hum_alert_status']= $result;
    } else {
        $alertMsg = false;
        $data[$i]['hum_alert_status']= $alertMsg;
    }

// High Probability Alert (1003)
// Temperature Warning (1004)
// Humidity Warning (1005)

// Smoke aslert
    if ($smoke >= $smokethreshold){

        // Validate the tempVar
        $alerttype=1006;
        $alertMsg = '<p>The Node ID: '.$sensorid.' is sensing SMOKE. The current smoke Level is: '.$smoke.'</p>';
        $data[$i]['smoke_alert']=$alertMsg;

        // Send email function
        //mail($to_mail, $subject,$alertMsg,$headers);
        echo "<script type='text/javascript'>alert('$alertMsg');</script>";

        // Insert Alert into Log
        $insertSql = 'INSERT INTO sensoralerts (typeid,sensorid,alertmsg) VALUES ('.$alerttype.','.$sensorid.',"'.$alertMsg.'");';
        $result = mysqli_query($link, $insertSql) or die (mysqli_error($link));
        $data[$i]['smoke_alert_status']= $result;
    } else {
        $alertMsg = false;
        $data[$i]['smoke_alert_status']= $alertMsg;
    }
}

//now print the data
print json_encode($data);

//free memory associated with result
//$result->close();

//close connection
//$mysqli->close();
?>
