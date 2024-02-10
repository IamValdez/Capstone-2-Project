<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['famsid']==0)) {
  header('location:logout.php');
  } else{


  }

// ERROR DISPLAY
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function AppointMentMailer($email, $fname, $remark, $status )
{

    try {
        $mail = new PHPMailer(true);

// Server settings
        // $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cjvaldez151@gmail.com';
        $mail->Password = 'dnhweufoarawpkxt';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
// Recipients
        $mail->setFrom('cjvaldez151@gmail.com', 'USER ACCOUNT CONFIRMATION');
        $mail->addAddress($email, $fname); // Add a recipient

// Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'PHP MAILER TEST';
        $mail->Body = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            line-height: 1.2;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        p {
            margin-bottom: 10px;
        }

        .appointment-number {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Student Account</h2>
        <p>Dear ' . $fname . ',</p>
        <p>Your account has been created. Below are your account details:</p>

        <p><strong>Appointment : </strong> Thesis Consultation</p>
        <p><strong>Appointment Status : </strong> ' .$status.'</p>
        <p><strong>Remark : </strong> '.$remark.'</p>
        

        <p><strong>Location:</strong> SVCC Complex Mamatid, City of Cabuyao, Laguna</p>

        <div class="footer">
            <p>This is the status of your appointment request. If you have any questions, feel free to contact us at github.com/IamValdez .</p>
        </div>
        <div class="footer">
        <p>BSIT 4A2 | Capstone - Group 12</p>
    </div>
    </div>
</body>

</html>
 ';
        $mail->send();

        return true;
    } catch (Exception $e) {
        echo '<script>alert("ERROR while sending email.")</script>';

        return false;
    }

}
if (isset($_POST['submit'])) {
  $eid = $_GET['editid'];
  $aptid = $_GET['aptid'];
  $status = $_POST['status'];
  $remark = $_POST['remark'];
  $sql = "update tblappointment set Status=:status,Remark=:remark where ID=:eid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':status', $status, PDO::PARAM_STR);
  $query->bindParam(':remark', $remark, PDO::PARAM_STR);
  $query->bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();

  if ($query) {
      AppointMentMailer($email, $fname, $remark, $status);
      echo '<script>
              document.addEventListener("DOMContentLoaded", function() {
                  Swal.fire({
                      title: "Success!",
                      text: " Appointment Updated Successfully.",
                      icon: "success",
                      confirmButtonColor: "#3085d6",
                      confirmButtonText: "OK",
                      customClass: {
                          container: "custom-sweetalert-container",
                          popup: "custom-sweetalert-popup",
                          title: "custom-sweetalert-title",
                          text: "custom-sweetalert-text",
                          confirmButton: "custom-sweetalert-confirm-button"
                      }
                  });
              });
          </script>';
  } else {
      echo '<script>
              Swal.fire({
                  icon: "error",
                  title: "Error!",
                  text: "Something Went Wrong. Please try again",
              });
          </script>';
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>View Appointment Detail</title>
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
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<!-- endbuild -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	<script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
	<script>
		Breakpoints();
	</script>

<style>
        /* Define your custom styles for the print button */
        .print-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #9a3b3b;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }
        .print-button:hover {
          opacity: 0.9;

        }
    </style>
	
</head>
	
<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->



<?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>



<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
  
  <div class="wrap">
      <section class="app-content">
       <div class="row">
		  	<!-- DOM dataTable -->
		  	<div class="col-md-12">
				  <div class="widget">
				    <header class="widget-header">
					  	<h4 class="widget-title" style="color: blue">Appointment Details</h4>
				  	</header><!-- .widget-header -->
				    	<hr class="widget-separator">
        
              <div class="widget-body">
                <div class="table-responsive" id="appointmentTable">
              
							<?php
                  $eid=$_GET['editid'];
$sql="SELECT * from tblappointment  where ID=:eid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
							<table border="1" class="table table-bordered mg-b-0">
                                            <tr>
    <th>Appointment Number</th>
    <td><?php  echo $aptno=($row->AppointmentNumber);?></td>
    <th>Student Name</th>
    <td><?php  echo $row->Name;?></td>
  </tr>
  
  <tr>
    <th>Mobile Number</th>
    <td><?php  echo $row->MobileNumber;?></td>
    <th>Email</th>
    <td><?php  echo $row->Email;?></td>
  </tr>
   <tr>
    <th>Appointment Date</th>
    <td><?php  echo $row->AppointmentDate;?></td>
    <th>Appointment Time</th>
    <td><?php  echo $row->AppointmentTime;?></td>
  </tr>
   
  <tr>
    <th>Apply Date</th>
    <td><?php  echo $row->ApplyDate;?></td>
     <th>Appointment Final Status</th>

    <td colspan="4"> <?php  $status=$row->Status;
    
if($row->Status=="")
{
  echo "Not yet updated";
}

if($row->Status=="Approved")
{
 echo "Your appointment has been approved";
}


if($row->Status=="Cancelled")
{
  echo "Your appointment has been cancelled";
}



     ;?></td>
  </tr>
   <tr>
    
<th >Remark</th>
 <?php if($row->Remark==""){ ?>

                     <td colspan="3"><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td colspan="3"> <?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } ?>
   
  </tr>
 
<?php $cnt=$cnt+1;}} ?>

</table> 
<br>

 
<?php 

if ($status=="" ){
?> 
<p align="center"  style="padding-top: 20px">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Take Action</button></p>  

<?php } ?>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                 <form method="post" name="submit">

                                
                               
     <tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr> 
     
  <tr>
    <th>Status :</th>
    <td>

   <select name="status" class="form-control wd-450" required="true" >
     <option value="Approved" selected="true">Approved</option>
     <option value="Cancelled">Cancelled</option>
     
   </select></td>
  </tr>
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Update</button>


  </form>
  

</div>


                      
                        </div>
                    </div>

						</div>

					</div><!-- .widget-body -->
					<div class="row">
                
        <!-- Add a Print button -->
    <button class="print-button" onclick="printReport()" style="margin-left: 36%; width: 20%; height: 45px">Print Appointment</button>

    <script>
        function printReport() {
            var printContents = document.getElementById("appointmentTable").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

   
				</div><!-- .widget -->
			</div><!-- END column -->
		</div><!-- .row -->
	</section><!-- .app-content -->
</div><!-- .wrap -->

<br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <!-- APP FOOTER -->
  <?php include_once('includes/footer.php');?>
  <!-- /#app-footer -->
</main>
<!--========== END app main -->

	<!-- APP CUSTOMIZER -->
<?php include_once('includes/customizer.php');?>

	
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


