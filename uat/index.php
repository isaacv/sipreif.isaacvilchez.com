<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/ico" />

        <title>SIPREIF | HOME</title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">

        <script>
            $( function() {
                $( "#datepicker" ).datepicker();
            });
        </script>
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>SIPREIF</span></a>
                        </div>
                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome</span>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                          <div class="menu_section">
                            <h3>ISAACV</h3>
                            <ul class="nav side-menu">
                              <li><a href="index.php"><i class="fa fa-home"></i> Home </a>
                              </li>

                              <li><a href="table.php"><i class="fa fa-table"></i> Tables </a>
                              </li>

                              <li><a href="charts.php"><i class="fa fa-bar-chart-o"></i> Data Representation </a>
                              </li>

                              <li><a href="contact.html"><i class="fa fa-edit"></i> Contact </a>
                              </li>
                             </ul>
                          </div>

                        </div>
                        <!-- /sidebar menu -->

                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <nav class="nav navbar-nav">
                            <ul class=" navbar-right">
                                <li class="nav-item dropdown open" style="padding-left: 15px;">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                        <img src="images/img.jpg" alt="">John Doe
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">

                    <!-- DB Connection test-->
                    <div>
                        <h3>Connect to database:</h3>
<!-- Connecting to the DB sipreif -->
<?php
//mysqli_connect(host, username, password, dbname)
$link = @mysqli_connect("localhost", "root", "EvaMarielle19*", "sipreif") or die("ERROR: Unable to connect: " . mysqli_connect_error());

echo "<p>Connected successfully to the database.</p>";
?>

<!-- Retrieving data for widgets first row -->
<?php
include "var-insert.php";
?>
<!-- Retrieving data for widgets first row -->
<?php
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=111 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row1 = mysqli_fetch_array($result);
    //print_r("Sensor ID: ".$row1[0]." || Sensor Temp: ".$row1[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=211 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row2 = mysqli_fetch_array($result);
    //print_r("Sensor ID: ".$row2[0]." || Sensor Temp: ".$row2[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=311 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row3 = mysqli_fetch_array($result);
    //print_r("Sensor ID: ".$row3[0]." || Sensor Temp: ".$row3[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=112 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row4 = mysqli_fetch_array($result);
    //print_r("Sensor ID: ".$row3[0]." || Sensor Temp: ".$row3[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=212 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row5 = mysqli_fetch_array($result);
    //print_r("Sensor ID: ".$row3[0]." || Sensor Temp: ".$row3[1]);
}
$sql= "SELECT id,temperature,humidity FROM varBoscosas WHERE id=312 ORDER BY unix DESC LIMIT 1;";
if($result = mysqli_query($link, $sql)){
    $row6 = mysqli_fetch_array($result);
    //print_r("Sensor ID: ".$row3[0]." || Sensor Temp: ".$row3[1]);
}
?>
                    </div>

                    <!-- top tiles -->
                    <div class="row" style="display: inline-block;" >
                        <div class="tile_count">
                            <div class="col-md-2 col-sm-4  tile_stats_count">
                                <span class="count_top"><i class="fa fa-user"></i>
<?php
print(" Sensor ID: ".$row1[0]);
?>
                                </span>
                                <div class="count">
<?php
print("T: ".$row1[1]."F");
?>
                                </div>
                                <span class="count_bottom"><i class="green">
                                  <?php
                                  print($row1[2]."%");
                                  ?>
                                </i> Relative humidity</span>
                            </div>
                            <div class="col-md-2 col-sm-4  tile_stats_count">
                                <span class="count_top"><i class="fa fa-user"></i>
<?php
print(" Sensor ID: ".$row2[0]);
?>
                                </span>
                                <div class="count">
<?php
print("T: ".$row2[1]."F");
?>
                                </div>
                                <span class="count_bottom"><i class="green"><?php
                                print($row2[2]."%");
                                ?></i> Relative humidity</span>
                            </div>
                            <div class="col-md-2 col-sm-4  tile_stats_count">
                                <span class="count_top"><i class="fa fa-user"></i>
<?php
print(" Sensor ID: ".$row3[0]);
?>
                                </span>
                                <div class="count">
<?php
print("T: ".$row3[1]."F");
?>
                                </div>
                                <span class="count_bottom"><i class="green"><?php
                                print($row3[2]."%");
                                ?>
                              </i> Relative humidity</span>
                            </div>
                            <div class="col-md-2 col-sm-4  tile_stats_count">
                                <span class="count_top"><i class="fa fa-user"></i>
<?php
print(" Sensor ID: ".$row4[0]);
?>
                                </span>
                                <div class="count">
<?php
print("T: ".$row4[1]."F");
?>
                                </div>
                                <span class="count_bottom"><i class="green"><?php
                                print($row4[2]."%");
                                ?></i> Relative humidity</span>
                            </div>
                            <div class="col-md-2 col-sm-4  tile_stats_count">
                                <span class="count_top"><i class="fa fa-user"></i>
<?php
print(" Sensor ID: ".$row5[0]);
?>
                                </span>
                                <div class="count">
<?php
print("T: ".$row5[1]."F");
?>
                                </div>
                                <span class="count_bottom"><i class="green"><?php
                                print($row5[2]."%");
                                ?></i> Relative humidity</span>
                            </div>
                            <div class="col-md-2 col-sm-4  tile_stats_count">
                                <span class="count_top"><i class="fa fa-user"></i>
<?php
print(" Sensor ID: ".$row6[0]);
?>
                                </span>
                                <div class="count">
<?php
print("T: ".$row6[1]."F");
?>
                                </div>
                                <span class="count_bottom"><i class="green"><?php
                                print($row6[2]."%");
                                ?></i> Relative humidity</span>
                            </div>
                        </div>
                    </div>
                    <!-- /top tiles -->

                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="dashboard_graph">
                                <div class="row x_title">
                                    <div class="col-md-6">
                                        <h3>SENSORS <small>Historical Temperature Performance</small></h3>

                                    </div>
                                    <div class="col-md-6">
                                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-9 ">
                                    <canvas id="mylineChart"></canvas>
                                </div>


                                <!-- PROBABILITY OF IGNITION -->
                                <div class="col-md-3 col-sm-3  bg-white">
                                    <div class="x_title">
                                        <h2>Probability of Ignition</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 ">
                                        <div>
                                          <?php
                                          print('<p>Sensor '.($row1[0]).'</p>');
                                          ?>
                                            <div class="">
                                                <div class="progress progress_sm" style="width: 76%;">
                                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal=<?php print($row1[1]) ?>></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                          <?php
                                          print('<p>Sensor '.$row2[0].'</p>');
                                          ?>
                                            <div class="">
                                                <div class="progress progress_sm" style="width: 76%;">
                                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php print($row2[1]) ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                          <?php
                                          print('<p>Sensor '.$row3[0].'</p>');
                                          ?>
                                            <div class="">
                                                <div class="progress progress_sm" style="width: 76%;">
                                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php print($row3[1]) ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                          <?php
                                          print('<p>Sensor '.$row4[0].'</p>');
                                          ?>
                                            <div class="">
                                                <div class="progress progress_sm" style="width: 76%;">
                                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php print($row4[1]) ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                          <?php
                                          print('<p>Sensor '.$row5[0].'</p>');
                                          ?>
                                            <div class="">
                                                <div class="progress progress_sm" style="width: 76%;">
                                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php print($row5[1]) ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                          <?php
                                          print('<p>Sensor '.$row6[0].'</p>');
                                          ?>
                                            <div class="">
                                                <div class="progress progress_sm" style="width: 76%;">
                                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php print($row6[1]) ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <br />
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">Gentelella - Bootstrap Admin Template by <a href="https://isaacvilchez.com">Isaac Vilchez</a></div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="../vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="../vendors/Flot/jquery.flot.js"></script>
        <script src="../vendors/Flot/jquery.flot.pie.js"></script>
        <script src="../vendors/Flot/jquery.flot.time.js"></script>
        <script src="../vendors/Flot/jquery.flot.stack.js"></script>
        <script src="../vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="../vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>

        <script type="text/javascript" src="../uat/js/line-db-php.js"></script>
<?php
// PHP program to pop an alert
// message box on the screen
$data = array();
$sensors = array();

// Defining limits for alerts
$templim=105;
$humthreshold=10;
$smokethreshold=400;
$tempwarn=80;

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

// High temp alert (1001)
    if ($temp > $templim){

        // Validate the tempVar
        $alerttype=1001;
        $alertMsg = '<p>There is an alert due to High Temp.<br />- Alerting Node ID: '.$sensorid.'<br />- Registed Temperature: '.$temp.'</p>';
        $data[$i]['temp_alert']=$alertMsg;

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

        echo "<script type='text/javascript'>alert('$alertMsg');</script>";
        // Insert Alert into Log
        $insertSql = 'INSERT INTO sensoralerts (typeid,sensorid,alertmsg) VALUES ('.$alerttype.','.$sensorid.',"'.$alertMsg.'");';
        $result = mysqli_query($link, $insertSql) or die (mysqli_error($link));
        $data[$i]['hum_alert_status']= $result;
    } else {
        $alertMsg = false;
        $data[$i]['hum_alert_status']= $alertMsg;
    }

// Smoke aslert
    if ($smoke >= $smokethreshold){
        // Validate the tempVar
        $alerttype=1006;
        $alertMsg = '<p>The Node ID: '.$sensorid.' is sensing SMOKE. The current smoke Level is: '.$smoke.'</p>';
        $data[$i]['smoke_alert']=$alertMsg;

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
?>
<?php
mysqli_free_result($result);
?>
    </body>
</html>
