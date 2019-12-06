<?php
/**
 * filename: lineTempF.php
 * description: this will return the score of the teams.
 */

//setting header to json
header('Content-Type: application/json');

//mysqli_connect(host, username, password, dbname)
//$link = @mysqli_connect("localhost", "root", "LaIsLgEm19*", "sipreif") or die("ERROR: Unable to connect: " . mysqli_connect_error());
include 'conndb.php';

$data = array();

// set the number of items to display per page
$items_per_page = 20;

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

// build query
$offset = ($page - 1) * $items_per_page;
$last_item = $page * $items_per_page;

$page_count = 0;

$url_link = 'http://sipreif.isaacvilchez.com/sensor.php?page=' . $page . ' - RANGE: ' . $offset . ' to last';

print $url_link;
print('hello');

$sql= "SELECT * FROM varBoscosas WHERE id=111 ORDER BY unix DESC LIMIT ".$offset.",".$last_item;
if($result = mysqli_query($link, $sql)){
  //array_push($data, $url_link);
  foreach ($result as $row) {
    $data[] = $row;
  }
    //now print the data
    //print json_encode($row);
}
//now print the data
print json_encode($data);

//free memory associated with result
//$result->close();

//close connection
//$mysqli->close();
?>