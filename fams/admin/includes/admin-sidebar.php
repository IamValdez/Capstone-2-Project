<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
  
</body>
</html>


<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)"><img class="img-responsive" src="assets/images/logo.jpg" alt="avatar" /></a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">

          <h5><a href="javascript:void(0)" class="username"><?php echo $_SESSION['FullName'];  ?></a></h5>
          <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <small><?php echo $_SESSION['famsemailid'];  ?></small>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu animated flipInY">
                <li>
                  <a class="text-color" href="dashboard.php">
                    <span class="m-r-xs"><i class="fa fa-home"></i></span>
                    <span>Home</span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="profile.php">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>Profile</span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="change-password.php">
                    <span class="m-r-xs"><i class="fa fa-gear"></i></span>
                    <span>Settings</span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a class="text-color" href="logout.php">
                    <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                    <span>logout</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->



  <div class="menubar-scroll">

    <div class="menubar-scroll-inner">

      <ul class="app-menu">
        <h4 class="brand-name" style=" color: #9a3b3b; margin:10px 0 10px 20px; font-weight: bold;">Apps</h4>
        <li class="has-submenu">

          <a href="dashboard.php">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Dashboard</span>

          </a>

        </li>
        <li>
    <a href="all-appointments.php">
        <i class="menu-icon zmdi zmdi-assignment-check zmdi-hc-lg"></i>
        <span class="menu-text">Student Appointment</span>
    </a>
</li>




        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-account-add zmdi-hc-lg"></i>
            <span class="menu-text">User Management</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <!-- nested submenu -->
            <li class="has-submenu">
              <a href="javascript:void(0)" class="submenu-toggle">
                <span class="menu-text">Add New User</span>
                <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
              </a>
              <ul class="submenu">
                <li><a href="admin-signup.php"><span class="menu-text">Admin</span></a></li>
                <li><a href="signup.php"><span class="menu-text">Faculty</span></a></li>
                <li><a href="student-signup.php"><span class="menu-text">Student</span></a></li>
              </ul>
              <!-- <a href="signup.php"><span class="menu-text">Add User</span></a> -->
            </li>
            <li><a href="all-user.php"><span class="menu-text">All User</span></a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <i class="menu-icon zmdi zmdi-calendar zmdi-hc-lg"></i>
            <span class="menu-text">Calendar</span>
          </a>
        </li>

        <li>
          <a href="#">
            <i class="menu-icon zmdi zmdi-email zmdi-hc-lg"></i>
            <span class="menu-text">Message Request</span>
          </a>
        </li>

        <li>
         <a href="report.php">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">Data Report</span>
          </a>
        </li>


        <h4 class="brand-name" style=" color: #9a3b3b; margin:10px 0 10px 20px; font-weight: bold;">Manage</h4>

        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
            <span class="menu-text">Account Control</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="#"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>My Profile</a></li>
            <li><a href="#"><i class="zmdi m-r-md zmdi-hc-lg zmdi-balance-wallet"></i>Change Password</a></li>
        </li>

      </ul><!-- .app-menu -->

      </li>



      <li>
        <a href="logout.php">
          <i class="menu-icon fa fa-power-off zmdi-hc-lg"></i>
          <span class="menu-text">Log Out</span>
        </a>
      </li>






    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>