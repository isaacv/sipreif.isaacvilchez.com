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
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">

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

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                </li>
                                    <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a></li>
                                    <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->

                    </div>
                </div>

                <!-- page content -->
                <div class="right_col" role="main">

                    <!-- DB Connection test-->
                    <div>
<!-- Connecting to the DB sipreif -->
<?php
//mysqli_connect(host, username, password, dbname)
$con= @mysqli_connect("localhost", "root", "EvaMarielle19*", "sipreif") or die("ERROR: Unable to connect: " . mysqli_connect_error());
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="dashboard_graph">
                                <div class="row x_title">
                                    <div class="col-md-6">
                                        <h3>SENSORS <small>Historical Temperature Performance</small></h3>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                  <table class="table table-striped table-bordered">
                                    <thead>
                                      <tr>
                                        <th style='width:50px;'>Time (Unix)</th>
                                        <th style='width:200px;'>Sensor ID</th>
                                        <th style='width:50px;'>Latitude</th>
                                        <th style='width:200px;'>longitude</th>
                                        <th style='width:200px;'>Temperature (ºF)</th>
                                        <th style='width:200px;'>Humidity (%)</th>
                                        <th style='width:200px;'>Smoke Concentration Sensed (0-1000)</th>
                                  </tr>
<?php
// Get the current page Number
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
        }
// Set the total amount of records per page
if (isset($_GET['records']) && $_GET['records']!="") {
    $total_records_per_page = $_GET['records'];
    } else {
        $total_records_per_page = 25;
        }

// Calculate OFFSET value and set "prev/next"
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

// Get the Total Number of Pages for Pagination
$result_count = mysqli_query(
$con,
"SELECT COUNT(*) As total_records FROM `varBoscosas`"
);
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total pages minus 1

// Fetching Limited Records using LIMIT Clause and OFFSET
$result = mysqli_query(
    $con,
    "SELECT * FROM `varBoscosas` ORDER BY unix DESC LIMIT $offset, $total_records_per_page"
    );
while($row = mysqli_fetch_array($result)){
    echo "<tr>
 <td>".$row['unix']."</td>
 <td>".$row['id']."</td>
 <td>".$row['latitude']."</td>
 <td>".$row['longitude']."</td>
 <td>".$row['temperature']."</td>
 <td>".$row['humidity']."</td>
 <td>".$row['smokeVar']."</td>
 </tr>";
        }
mysqli_close($con);
?>
                                  <!-- All your PHP Script will be here -->
                                </tbody>
                              </table>
                                </div>
<div class="clearfix"></div>
                                <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                                  <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
                                </div>

                                <ul class="pagination pagination-split">
                                <?php if($page_no > 1){
                                echo "<li class='btn'><a href='?page_no=1'>First Page</a></li>";
                                } ?>

                                <li class='btn <?php if($page_no <= 1){ echo "btn.disabled"; } ?>'>
                                <a <?php if($page_no > 1){
                                echo "href='?page_no=".$previous_page."'";
                                } ?>>Previous</a>
                                </li>

                                <?php
                                if ($total_no_of_pages <= 10){
                                 for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                                 if ($counter == $page_no) {
                                 echo "<li class='btn btn.active'><a>".$counter."</a></li>";
                                         }else{
                                        echo "<li class='btn'><a href='?page_no=".$counter."'>".$counter."</a></li>";
                                                }
                                        }
                                } elseif ($total_no_of_pages > 10){
                                // Here we will add further conditions
                                if($page_no <= 4) {
                                 for ($counter = 1; $counter < 8; $counter++){
                                   if ($counter == $page_no) {
                                    echo "<li class='btn btn.active'><a>".$counter."</a></li>";
                                    } else{
                                      echo "<li class='btn'><a href='?page_no=".$counter."'>".$counter."</a></li>";
                                    }
                                }
                                echo "<li class='btn'><a>...</a></li>";
                                echo "<li class='btn'><a href='?page_no=".$second_last."'>".$second_last."</a></li>";
                                echo "<li class='btn'><a href='?page_no=".$total_no_of_pages."'>".$total_no_of_pages."</a></li>";
                                } elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                echo "<li class='btn'><a href='?page_no=1'>1</a></li>";
                                echo "<li class='btn'><a href='?page_no=2'>2</a></li>";
                                echo "<li class='btn'><a>...</a></li>";
                                for (
                                     $counter = $page_no - $adjacents;
                                     $counter <= $page_no + $adjacents;
                                     $counter++
                                     ) {
                                     if ($counter == $page_no) {
                                       echo "<li class='btn btn.active'><a>".$counter."</a></li>";
                                     } else{
                                        echo "<li class='btn'><a href='?page_no=".$counter."'>$counter</a></li>";
                                          }
                                       }
                                echo "<li class='btn'><a>...</a></li>";
                                echo "<li class='btn'><a href='?page_no=".$second_last."'>".$second_last."</a></li>";
                                echo "<li class='btn'><a href='?page_no=".$total_no_of_pages."'>".$total_no_of_pages."</a></li>";
                                } else {
                                echo "<li class='btn'><a href='?page_no=1'>1</a></li>";
                                echo "<li class='btn'><a href='?page_no=2'>2</a></li>";
                                echo "<li class='btn'><a>...</a></li>";
                                for (
                                     $counter = $total_no_of_pages - 6;
                                     $counter <= $total_no_of_pages;
                                     $counter++
                                     ) {
                                     if ($counter == $page_no) {
                                       echo "<li class='btn btn.active'><a>".$counter."</a></li>";
                                     }else{
                                        echo "<li class='btn'><a href='?page_no=".$counter."'>".$counter."</a></li>";
                                      }
                                     }
                                }
                              }
                                ?>

                                <li class='btn <?php if($page_no >= $total_no_of_pages){
                                echo "btn.disabled";
                              } ?>'>
                                <a <?php if($page_no < $total_no_of_pages) {
                                echo "href='?page_no=".$next_page."'";
                                } ?>>Next</a>
                                </li>

                                <?php if($page_no < $total_no_of_pages){
                                echo "<li class='btn'><a href='?page_no=".$total_no_of_pages."'>Last &rsaquo;&rsaquo;</a></li>";
                                } ?>
                                </ul>

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

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>

<?php
mysqli_free_result($result);
?>
    </body>
</html>
