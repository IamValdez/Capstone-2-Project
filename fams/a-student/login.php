<?php
session_start();
error_reporting(0);
include 'includes/dbconnection.php';

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
    
    $sql = "SELECT ID, user_ID FROM tblfaculty WHERE user_ID=:email AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['famsid'] = $result->ID;
            $_SESSION['famsemailid'] = $result->user_ID;
        }
        $_SESSION['login'] = $_POST['email'];
    
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
       
        echo 'Swal.fire({
            icon: "question",
            title: "Verifying Your Account.",
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
                    window.location.href = "dashboard.php"; 
                }
            });
        }, 3000);'; 
    
        echo '});';
        echo '</script>';
    }
    


    else {
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





// Check if the login form was submitted
if (isset($_POST['save'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  
  $sql = "SELECT ID, user_ID FROM tblfaculty WHERE user_ID=:email AND Password=:password";
  $query = $dbh->prepare($sql);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->execute();
  
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  
  if ($query->rowCount() > 0) {
      foreach ($results as $result) {
          $_SESSION['famsid'] = $result->ID;
          $_SESSION['famsemailid'] = $result->user_ID;
      }
      $_SESSION['save'] = $_POST['email'];
  
      echo '<script>';
      echo 'document.addEventListener("DOMContentLoaded", function() {';
     
      echo 'Swal.fire({
          icon: "question",
          title: "Verifying Your Account.",
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
                  window.location.href = "../faculty/dashboard.php"; 
              }
          });
      }, 3000);'; 
  
      echo '});';
      echo '</script>';
  }
  


  else {
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

    <title>Student Sign in</title>
    <link rel="icon" href="./images/title/logo.jpg">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>


    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link rel="stylesheet" href="style1.css" />

</head>


<body>

 <div class="simple-page-wrap">
    <div class="container" id="container1">
      <!--STUDENT LOGIN PAGE-->

      <div class="form-container sign-in">
        <form method="post" name="login">
          <h1>Student Login</h1>
          <div class="social-icons">
            <a href="#" class="icon"
              ><i class="fa-brands fa-google-plus-g"></i
            ></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"
              ><i class="fa-brands fa-linkedin-in"></i
            ></a>
          </div>
          <span>or use your email password</span>
          <input
            type="text"
            class="form-control"
            placeholder="Enter Registered Student ID"
            required="true"
            name="email"
          />
          <input
            type="password"
            class="form-control password-input"
            placeholder="Password"
            name="password"
            required="true"
          />

          <span class="password-toggle-icon" onclick="togglePassword()"
            ><i class="fa fa-eye-slash"></i
          ></span>

          <!--SUBMIT -->
       
          <input
            type="submit"
            name="login"
            value="Sign In"
            id="signin-btn" style="background-color: #9a3b3b; color: #fff; font-size: 12px;
  padding: 10px 45px;
  border: 1px solid transparent;
  border-radius: 8px;
  font-weight: 600;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  margin-top: 10px;
  cursor: pointer;
  width: 150px;"
          />
          
          <!--
          <div id="login-attempts">
          <?php
          if ($_SESSION['login_attempts'] < 3) {
              echo "<p>Attempts left: " . (3 - $_SESSION['login_attempts']) . "</p>";
          }
          ?>
        </div>
        <p id="login-timer"></p>
        <br>
        <a href= "forgot-password.php">Forget Password?</a>

        -->
        <a href="#">Forget Your Password?</a></form>
      </div>

      <!--FACULTY LOGIN PAGE-->

      <div class="form-container sign-up">
        <form  method="post" name="login">
          <h1>Faculty Login</h1>
          <div class="social-icons">
            <a href="#" class="icon"
              ><i class="fa-brands fa-google-plus-g"></i
            ></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"
              ><i class="fa-brands fa-linkedin-in"></i
            ></a>
          </div>
          <span>or use your email password</span>
          <input
            type="text"
            class="form-control"
            placeholder="Enter Registered Student ID"
            required="true"
            name="email"
          />
          <input
            type="password"
            class="form-control password-input"
            placeholder="Password"
            name="password"
            required="true"
          />
          <span class="password-toggle-icon" onclick="togglePassword()"
            ><i class="fa fa-eye-slash"></i
          ></span>

          <!--submit-->
       
          <input
            type="submit"
            name="save"
            value="Sign In"
            id="signin-btn"
            style="background-color: #9a3b3b; color: #fff; font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
            width: 150px;"
          />

          <!--
          <div id="login-attempts">
          <?php
          if ($_SESSION['login_attempts'] < 3) {
              echo "<p>Attempts left: " . (3 - $_SESSION['login_attempts']) . "</p>";
          }
          ?>
        </div>
        <p id="login-timer"></p>
        <br>
        <a href= "forgot-password.php">Forget Password?</a>
-->   <a href="#">Forget Your Password?</a>
        </form>
      </div>

      <!--SIDE PANEL BACKGROUND-->
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Faculty AMS</h1>
            <p>Enter your personal details to use all of site features</p>
            <button class="hidden" id="login1">Next</button>
          </div>
          <div class="toggle-panel toggle-right">
            <h1>Faculty AMS</h1>
            <p>
            Enter your personal details to use all of site features
            </p>
            <button class="hidden" id="register1">Next</button>
          </div>
        </div>
      </div>
    </div>

    <script src="script.js"></script>
  </body>




  <script>
    function startTimer(duration) {
        var timer = duration, minutes, seconds;
        var intervalId = setInterval(function () {
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

    window.onload = function () {
        <?php
            if ($_SESSION['login_attempts'] >= 3) {
                echo "startTimer(60);";
                echo "disableSignInButton();";
            }
        ?>
    };
</script>


<script>
    window.onload = function () {
        <?php
            if ($_SESSION['login_attempts'] >= 3) {
                echo "startTimer(60);";
                echo "disableSignInButton();";
            }
        ?>
    };
</script>


