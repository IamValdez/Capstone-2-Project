<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the login attempts session variable is set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Handle login attempts and the 60-second timer
if ($_SESSION['login_attempts'] >= 3) {
    // Check if the timer has expired
    if (isset($_SESSION['login_timer_start']) && time() - $_SESSION['login_timer_start'] < 60) {
        $time_left = 60 - (time() - $_SESSION['login_timer_start']);
        echo "<script>
            document.getElementById('login-attempts').style.display = 'none';
            document.getElementById('login-timer').innerText = 'Please wait ' + $time_left + ' seconds before the next attempt.';
        </script>";
        echo "<script>
            startTimer($time_left);
            disableSignInButton();
        </script>";
        exit();
    } else {
        // Reset login attempts and start the timer
        $_SESSION['login_attempts'] = 0;
        $_SESSION['login_timer_start'] = time();
        echo "<script>
            document.getElementById('login-attempts').style.display = 'block';
            document.getElementById('login-timer').innerText = '';
            enableSignInButton();
        </script>";
    }
}

// Check if the login form was submitted
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT ID, Email FROM tblfaculty WHERE Email=:email AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();

    
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['famsid'] = $result->userID;
            $_SESSION['famsemailid'] = $result->Email;
        }
        $_SESSION['login'] = $_POST['email'];
    
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
    
        // First SweetAlert
        echo 'Swal.fire({
            icon: "question",
            title: "Verifying Your Account...",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
        });';
    
        // Second SweetAlert with a slight delay
        echo 'setTimeout(() => {
            Swal.fire({
                icon: "success",
                title: "Signed in successfully.",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 700,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                onClose: () => {
                    window.location.href = "dashboard.php"; // Redirect after both SweetAlerts are closed
                }
            });
        }, 3000);'; // Adjust the delay (in milliseconds) as needed
    
        echo '});';
        echo '</script>';
    
    } else {
        // Increment login attempts
        $_SESSION['login_attempts']++;
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
    
        // First SweetAlert
        echo 'Swal.fire({
            icon: "question",
            title: "Verifying Your Account...",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
        });';
    
        // Delay before showing the second SweetAlert
        echo 'setTimeout(function() {';
        echo 'Swal.fire({
            title: "Error!",
            text: " The username or password is incorrect or invalid. ",
            icon: "error",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK",
            customClass: {
                container: "custom-sweetalert-container",
                popup: "custom-sweetalert-popup",
                title: "custom-sweetalert-title",
                text: "custom-sweetalert-text",
                confirmButton: "custom-sweetalert-confirm-button"
            }
        });';
        echo '}, 4000);';
    
        echo '});';
        echo '</script>';
    
        if ($_SESSION['login_attempts'] >= 3) {
            // Display the cooldown and hide the login attempts
            echo "<script>
                document.getElementById('login-attempts').style.display = 'none';
                document.getElementById('login-timer').innerText = 'Please wait 60 seconds before the next attempt.';
            </script>";
            echo "<script>
                startTimer(60);
                disableSignInButton();
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Faculty Sign in</title>
    <link rel="icon" href="./images/title/logo.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/misc-pages.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">

</head>

   
  

<body>


    <div id="back-to-home">
        <a href="../user-selection.php" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>

        
        
    </div>

    
    <div class="simple-page-wrap">
        
        <div class="simple-page-logo animated swing">


            <span style="color: white">ST. VINCENT COLLEGE OF CABUYAO</span>

        </div><!-- logo -->
        <div class="simple-page-form" style = "background-color: white;" id="login-form" >
            
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#9a3b3b" fill-opacity="1" d="M0,288L30,266.7C60,245,120,203,180,197.3C240,192,300,224,360,202.7C420,181,480,107,540,101.3C600,96,660,160,720,192C780,224,840,224,900,218.7C960,213,1020,203,1080,165.3C1140,128,1200,64,1260,53.3C1320,43,1380,85,1410,106.7L1440,128L1440,0L1410,0C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0L0,0Z"></path></svg>

            <h4 class="form-title m-b-xl text-center">Sign In With Your Admin Account</h4>
            <form method="post" name="login">

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Registered Email ID" required="true" name="email">
                </div>

                <div class="form-group password-group">
                    <input type="password" class="form-control password-input" placeholder="Password" name="password" required="true">
                    <span class="password-toggle-icon" onclick="togglePassword()"><i class="fa fa-eye-slash"></i></span>
                </div>

                <input type="submit" class="btn btn-primary" name="login" value="Sign In" id="signin-btn">
            </form>
            <br>
<!--
            <div id="login-attempts">
                <?php
                if ($_SESSION['login_attempts'] < 3) {
                    echo "<p>Attempts left: " . (3 - $_SESSION['login_attempts']) . "</p>";
                }
                ?>
            </div>

            -->

            <p id="login-timer"></p> 
            <a href="forgot-password.php">Forget Password?</a>
            <hr />

        </div>



      

        <script>
            function togglePassword() {
                var passwordInput = document.querySelector(".password-input");
                var passwordToggleIcon = document.querySelector(".password-toggle-icon");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    passwordToggleIcon.innerHTML = '<i class="fa fa-eye"></i>';
                } else {
                    passwordInput.type = "password";
                    passwordToggleIcon.innerHTML = '<i class="fa fa-eye-slash"></i>';
                }
            }

            function startTimer(duration) {
                var timer = duration,
                    minutes, seconds;
                var intervalId = setInterval(function() {
                    if (timer <= 0) {
                        clearInterval(intervalId);
                        document.getElementById('login-timer').innerText = 'Cooldown period is over. You can sign in now.';
                        enableSignInButton();
                        return;
                    }

                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    document.getElementById('login-timer').innerText = 'Please wait ' + minutes + ":" + seconds + ' before the next attempt.';
                    disableSignInButton();

                    if (--timer < 0) {
                        timer = duration;
                    }
                }, 1000);
            }

            function disableSignInButton() {
                var signInBtn = document.getElementById('signin-btn');
                signInBtn.disabled = true;
            }

            function enableSignInButton() {
                var signInBtn = document.getElementById('signin-btn');
                signInBtn.disabled = false;
            }

            window.onload = function() {
                <?php
                if ($_SESSION['login_attempts'] >= 3) {
                    echo "startTimer(60);";
                    echo "disableSignInButton();";
                }
                ?>
            };
        </script>
            
        </body>

    </html>