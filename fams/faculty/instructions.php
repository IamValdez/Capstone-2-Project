<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['famsid']==0)) {
  header('location:logout.php');
  } else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Appointment Between Dates Report</title>
  <link rel="icon" href="images/logo.jpg">
  
  <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
  <!-- build:css assets/css/app.min.css -->
  <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
  <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/core.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <!-- endbuild -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
  <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
  
<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">

<style>
		/* Use a CSS reset to remove default styles from elements */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Use a CSS variable to set the background color */
:root {
  --background-color: #f2f2f2;
}

body {
  font-family: Arial, sans-serif;
  background-color: var(--background-color);

}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  text-align: center;
  
}

h1 {
  font-size: 36px;
  margin-bottom: 20px;
  text-align: center;
}

p {
  font-size: 18px;
  line-height: 1.5;
  margin-bottom: 30px;
  text-align: justify;
  padding: 0 20px;
}

ol {
  font-size: 18px;
  line-height: 1.5;
  margin-bottom: 30px;
  text-align: left;
  padding: 0 20px;
}

form {
  max-width: 500px;
  margin: 0 auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

label {
  display: block;
  font-size: 18px;
  margin-bottom: 10px;
}


  h1 {
    font-size: 28px;
    margin-bottom: 10px;
  }
  p,
  ol {
    font-size: 16px;
    margin-bottom: 20px;
    padding: 0 10px;
	
  }
  form {
    padding: 10px;
  }
}
li{
	margin-top: 20px;
}

		</style>


<h1>Welcome to our Faculty Appointment Management System</h1>
		
		<p>This system is only for the Faculty and Students of the college department in St. Vincent College of Cabuyao. This system will help address the concerns of students, such as school events, concerns, compliance activities, special projects, and so on. This system is a great help for the Faculty to professionally manage appointment requests from students and to avoid overlooking or ignoring the requests of the students towards the faculty.</p>
		
		<p>The use of this system has two parts:</p>
		
		<ol>

			<h4>Students Instruction</h4>
			<li>1. Use the system's domain name and type it into the browser on your mobile phone or computer.</li>
			<li>2. Explore the System.</li>
			<li>3. Check the College Department to see the names of specific faculties.</li>
			<li>4. Book an appointment using the visible booking form or the "Book" button in the header.</li>
			<li>5. Fill out the appointment request form based on the information in the form.</li>
			<li>6. Submit the form and it will automatically generate a random appointment number.</li>
			<li>7. Go to "Check Appointment".</li>
			<li>8. Type in the appointment number or mobile number and make sure that the number entered is correct.</li>
			<li>9. Use the "Contact" button for the school's reference number if there are any questions about using the system.</li>
		</ol>

		<br><br><br>
<ol>
		<h4>Faculty Instructions</h4>
			<li>1. Use the system's domain name and type it into the browser on your mobile phone or computer.</li>
			<li>2. Explore the System.</li>
			<li>3. Check the dashboard in the header.</li>
			<li>4. Click the notification icon and check the appointment requests.</li>
			<li>5. Look at the main table and identify the name and student ID to recognize the students.</li>
			<li>6. Click "Take Action" and you will see the status of the request and its remarks.</li>
			<li>7. Go to "Check Appointment".</li>
			<li>8. You can either cancel or approve the request of the students and give it a remark.</li>
			<li>9. Go to the dashboard to view the calendar and see if the approved request will pop up on the calendar.</li>
		</ol>



  <!-- APP FOOTER -->
  <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->
</main>
<!--========== END app main -->

<?php include_once('includes/customizer.php');?>
  
  <!-- SIDE PANEL -->

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
</body>
</html>


<?php }  ?>