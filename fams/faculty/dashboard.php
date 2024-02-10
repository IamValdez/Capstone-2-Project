<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['famsid']) == 0) {
    header('location:logout.php');
}

$facid = $_SESSION['famsid'];

// Fetch monthly appointment statistics for the faculty
$sqlMonthlyAppointments = "SELECT DATE_FORMAT(AppointmentDate, '%b') as month, COUNT(*) as count 
                           FROM tblappointment 
                           WHERE Faculty=:facid 
                           GROUP BY month
                           ORDER BY MONTH(AppointmentDate)";
$queryMonthlyAppointments = $dbh->prepare($sqlMonthlyAppointments);
$queryMonthlyAppointments->bindParam(':facid', $facid, PDO::PARAM_STR);
$queryMonthlyAppointments->execute();
$monthlyAppointmentsData = $queryMonthlyAppointments->fetchAll(PDO::FETCH_ASSOC);

// Fetch overall appointment statistics for the faculty
$sqlOverallAppointments = "SELECT 
            (SELECT COUNT(*) FROM tblappointment WHERE Status IS NULL AND Faculty=:facid) AS newCount,
            (SELECT COUNT(*) FROM tblappointment WHERE Status='Approved' AND Faculty=:facid) AS approvedCount,
            (SELECT COUNT(*) FROM tblappointment WHERE Status='Cancelled' AND Faculty=:facid) AS cancelledCount,
            (SELECT COUNT(*) FROM tblappointment WHERE Faculty=:facid) AS totalCount";
$queryOverallAppointments = $dbh->prepare($sqlOverallAppointments);
$queryOverallAppointments->bindParam(':facid', $facid, PDO::PARAM_STR);
$queryOverallAppointments->execute();
$overallAppointmentsData = $queryOverallAppointments->fetch(PDO::FETCH_ASSOC);

$newCount = $overallAppointmentsData['newCount'];
$approvedCount = $overallAppointmentsData['approvedCount'];
$cancelledCount = $overallAppointmentsData['cancelledCount'];
$totalCount = $overallAppointmentsData['totalCount'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Faculty Account</title>

    <link rel="icon" href="images/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="./assets/css/calendarMod.css">
    <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-o8J6iZck4COqGydRlXDtZQ/HEBRPyBKAv2bAC7QNF8lI5Uggw+2R6ZDrCKcUZffI" crossorigin="anonymous">
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->

    <?php include_once('includes/header.php'); ?>

    <?php include_once('includes/sidebar.php'); ?>

    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <div class="row-left">

                        <!-- Total New Appointment -->
                        <div class="col-md-3 col-sm-3">
                            <div class="widget stats-widget">
                                <div class="widget-body clearfix">
                                    <?php
                                    $facid = $_SESSION['famsid'];
                                    $sql = "SELECT * FROM tblappointment WHERE Status IS NULL && Faculty=:facid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':facid', $facid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $totnewapt = $query->rowCount();
                                    ?>
                                    <div class="pull-left">
                                        <h3 class="widget-title text-warning">
                                            <span class="counter" data-plugin="counterUp"><?php echo htmlentities($totnewapt); ?></span>
                                        </h3>
                                        <small class="text-color">Total New Appointment</small>
                                    </div>
                                    <span class="pull-right big-icon watermark">
                                        <i class="fa fa-calendar-plus-o" style="color: #f39c12;"></i><!-- Set the color here -->
                                    </span>
                                </div>
                                <footer class="widget-footer bg-warning">
                                    <a href="new-appointment.php"><small> View Detail</small></a>
                                    <span class="small-chart pull-right" data-plugin="sparkline" data-options="[4,3,5,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                                </footer>
                            </div><!-- .widget -->
                        </div>

                        <!-- Total Approved -->
                        <div class="col-md-3 col-sm-3">
                            <div class="widget stats-widget">
                                <div class="widget-body clearfix">
                                    <?php
                                    $facid = $_SESSION['famsid'];
                                    $sql = "SELECT * FROM tblappointment WHERE Status='Approved' && Faculty=:facid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':facid', $facid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $totappapt = $query->rowCount();
                                    ?>
                                    <div class="pull-left">
                                        <h3 class="widget-title text-success">
                                            <span class="counter" data-plugin="counterUp"><?php echo htmlentities($totappapt); ?></span>
                                        </h3>
                                        <small class="text-color">Total Approved</small>
                                    </div>
                                    <span class="pull-right big-icon watermark">
                                        <i class="fa fa-ban" style="color: #2ecc71;"></i><!-- Set the color here -->
                                    </span>
                                </div>
                                <footer class="widget-footer bg-success">
                                    <a href="approved-appointment.php"><small> View Detail</small></a>
                                    <span class="small-chart pull-right" data-plugin="sparkline" data-options="[1,2,3,5,4], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                                </footer>
                            </div><!-- .widget -->
                        </div>

                        <!-- Cancelled Appointment -->
                        <div class="col-md-3 col-sm-3">
                            <div class="widget stats-widget">
                                <div class="widget-body clearfix">
                                    <?php
                                    $facid = $_SESSION['famsid'];
                                    $sql = "SELECT * FROM tblappointment WHERE Status='Cancelled' && Faculty=:facid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':facid', $facid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $totncanapt = $query->rowCount();
                                    ?>
                                    <div class="pull-left">
                                        <h3 class="widget-title text-purple">
                                            <span class="counter" data-plugin="counterUp"><?php echo htmlentities($totncanapt); ?></span>
                                        </h3>
                                        <small class="text-color">Cancelled Appointment</small>
                                    </div>
                                    <span class="pull-right big-icon watermark">
                                        <i class="fa fa-unlock-alt" style="color: #5b69bc;"></i><!-- Set the color here -->
                                    </span>
                                </div>
                                <footer class="widget-footer bg-purple">
                                    <a href="cancelled-appointment.php"><small> View Detail</small></a>
                                    <span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,4,3,4,3], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                                </footer>
                            </div><!-- .widget -->
                        </div>

                        <!-- Total Appointment -->
                        <div class="col-md-3 col-sm-3">
                            <div class="widget stats-widget">
                                <div class="widget-body clearfix">
                                    <div class="pull-left">
                                        <?php
                                        $facid = $_SESSION['famsid'];
                                        $sql = "SELECT * FROM tblappointment WHERE Faculty=:facid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':facid', $facid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $totapt = $query->rowCount();
                                        ?>
                                        <h3 class="widget-title" style="color: #9a3b3b">
                                            <span class="counter" data-plugin="counterUp"><?php echo htmlentities($totapt); ?></span>
                                        </h3>
                                        <small class="text-color">Total Appointment</small>
                                    </div>
                                    <span class="pull-right big-icon watermark">
                                        <i class="fa fa-file-text-o" style="color: #9a3b3b;"></i><!-- Set the color here -->
                                    </span>
                                </div>
                                <footer class="widget-footer bg-primary">
                                    <a href="all-appointment.php"><small> View Detail</small></a>
                                    <span class="small-chart pull-right" data-plugin="sparkline" data-options="[5,4,3,5,2],{ type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                                </footer>
                            </div><!-- .widget -->
                        </div>

                    </div><!-- .row -->


                </div><!-- .row -->
                <!-- Graph -->
                <div class="graphBox">
                    <div class="box">
                        <canvas id="myDoughnutChart"></canvas>
                    </div>
                    <div class="box">
                        <div class="dropdowm">
                            <button class="dropbtm">Print</button>
                            <button onclick="toggleDropdown()" class="dropbtn">View Data</button>
                            <div id="dropdowm-content" class="dropdowm-content">
                                <a id="weekly" class="chartDropdown">Weekly</a>
                                <a id="monthly" class="chartDropdown">Monthly</a>
                                <a id="yearly" class="chartDropdown">Yearly</a>


                            </div>
                        </div>
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
        </div>
        </div>
        </section><!-- #dash-content -->
        </div><!-- .wrap -->

        <!-- APP FOOTER -->
        <?php include_once('includes/footer.php'); ?>
        <!-- /#app-footer -->
    </main>
    <!--========== END app main -->

    <?php include_once('includes/customizer.php'); ?>

    <!-- build:js assets/js/core.min.js -->
    <script src="libs/bower/jquery/dist/jquery.js"></script>
    <script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
    <script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
    <script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
    <script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="libs/bower/PACE/pace.min.js"></script>
    <!-- endbuild -->

    <!-- build:js assets/js/app.min.js -->
    <script src="assets/js/library.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- endbuild -->
    <script src="libs/bower/moment/moment.js"></script>
    <script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>



    <!-- build:js assets/js/app.min.js -->
    <script src="libs/bower/jquery/dist/jquery.js"></script>
    <script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
    <script src="libs/bower/moment/moment.js"></script>
    <script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- endbuild -->

    <script src="assets/js/core.js"></script>
    <script src="assets/js/app.js"></script>


    <script>
        $(document).ready(function() {
            var doughnutCtx = document.getElementById("myDoughnutChart").getContext("2d");
            var barCtx = document.getElementById("myBarChart").getContext("2d");

            // Initialize doughnut chart for overall appointment statistics
            var doughnutChart = new Chart(doughnutCtx, {
                type: "doughnut",
                data: {
                    labels: ["New", "Approved", "Cancelled", "Total"],
                    datasets: [{
                        label: "# of Appointments",
                        data: [<?= $newCount; ?>, <?= $approvedCount; ?>, <?= $cancelledCount; ?>, <?= $totalCount; ?>],
                        backgroundColor: ["rgba(249, 200, 81, 1)", "rgba(16, 196, 105, 1)", "rgba(91, 105, 188, 1)", "rgba(154, 59, 59, 1)"],
                    }],
                },
                options: {
                    responsive: true,
                },
            });

            // Extract monthly appointment statistics data
            var allMonths = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var monthlyLabels = <?= json_encode(array_column($monthlyAppointmentsData, 'month')); ?>;
            var monthlyData = <?= json_encode(array_column($monthlyAppointmentsData, 'count')); ?>;


            // Assign zero values for months without data
            for (var i = 0; i < allMonths.length; i++) {
                var monthIndex = monthlyLabels.indexOf(allMonths[i]);
                if (monthIndex === -1) {
                    monthlyLabels.splice(i, 0, allMonths[i]);
                    monthlyData.splice(i, 0, 0);
                }
            }

            // Initialize bar chart for monthly appointment statistics
            var barChart = new Chart(barCtx, {
                type: "bar",
                data: {
                    // labels: monthlyLabels,
                    datasets: [{
                        label: "Total of Students Appointments",
                        // data: ,
                        backgroundColor: " rgba(154, 59, 59, 1)",
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1,
                        },
                    },
                },
            });

            // AJAX fetch 
            const fetchBarChart = async (timePeriod) => {
                await $.ajax({
                    type: 'GET',
                    url: 'ajax.php',
                    data: {
                        timePeriod: timePeriod ? timePeriod : "monthly"
                    },
                    success: function(response) {
                        try {
                            const {
                                data,
                                labels
                            } = response;
                            console.log(response);
                            console.log("time period", timePeriod)
                            console.log("chart data:", data)

                            barChart.data.datasets[0].data = data;
                            barChart.data.labels = timePeriod === "monthly" ? monthlyLabels : labels;
                            barChart.update();
                        } catch (error) {
                            console.error('Error parsing JSON data:', error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            // AJAX FETCH HERE
            fetchBarChart("monthly") //initial render

            // fetch on dropdown event
            $(".chartDropdown").on("click ", async (e) => {
                await fetchBarChart($(e.currentTarget).attr("id"))
            })


        });

        document.getElementById("weekly").addEventListener("click", handleDropdownClick);
        document.getElementById("monthly").addEventListener("click", handleDropdownClick);
        document.getElementById("yearly").addEventListener("click", handleDropdownClick);


        function toggleDropdown() {
            var dropdownContent = document.getElementById("dropdowm-content");
            dropdownContent.style.display =
                dropdownContent.style.display === "block" ? "none" : "block";
        }
    </script>

</body>

</html>

</body>

</html>