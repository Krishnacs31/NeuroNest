<?php
session_start();
#error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Neuronest</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="icon" href="logo.png" type="image/x-icon">


    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
			  <img
                src="../assets/img	 /logo.png"
                alt="navbar brand"
                class="navbar-brand"
                height="40"
				style="border-radius:10px"
              />
			  <a href=""><h3 style="color:white;">&nbsp;NeuroNest</h3></a>
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <?php
			  if($_SESSION['user']=='parent')
			  {
			  ?>
			  
			  <li class="nav-item active">
                <a
                  href="../dashboard/dashboard.php"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a
                  href="../routine/select.php"
                >
                  <i class="fas fa-calendar-times"></i>
                  <p>Child's Routine</p>
                </a>
              </li>
			  <li class="nav-item">
                <a
                  href="../dashboard/report.php"
                >
                  <i class="fas fa-paper-plane"></i>
                  <p>Report</p>
                </a>
              </li>
			  
			  
			  <li class="nav-item">
                <a
                  href="../chat/select1.php"
                >
                  <i class="fab fa-rocketchat"></i>
                  <p>Trainer Chat</p>
                </a>
              </li>
			  <!--
			  <li class="nav-item">
                <a
                  href="#"
                >
                  <i class="far fa-comments"></i>
                  <p>Feedback</p>
                </a>
              </li>
			  -->
			  
			  <li class="nav-item">
                <a
                  href="../child/select.php"
                >
                  <i class="fas fa-user-circle"></i>
                  <p>Child Profile</p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a
                  href="../pprofile/select.php"
                >
				  <i class="fas fa-user-alt"></i>
                  <p>Profile</p>
                </a>
              </li>
			  <!--
			  <li class="nav-item">
                <a
                  href="#"
                >
                  <i class="fas fa-sun"></i>
                  <p>Settings</p>
                </a>
              </li>
			  -->
			  
			  
			  <?php
			  }elseif($_SESSION['user']=='admin')
			  {
			  ?>
			  <li class="nav-item active">
                <a
                  href="../dashboard/admin.php"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
			  
			  <?php
			  }elseif($_SESSION['user']=='trainer')
			  {
			  ?>
			  <li class="nav-item active">
                <a
                  href="../dashboard/trainer.php"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a
                  href="../courses/courses1.php"
                >
                  <i class="fas fa-book-open"></i>
                  <p>Activities</p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a
                  href="../trainer/profile.php"
                >
                  <i class="fas fa-user-alt"></i>
                  <p>Profile</p>
                </a>
              </li>
			  <?php
			  }
			  ?>
			  <li class="nav-item">
                <a href="../login/logout.php">
                  <i class="fas fa-power-off"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="../assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
                >
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input
                          type="text"
                          placeholder="Search ..."
                          class="form-control"
                        />
                      </div>
                    </form>
                  </ul>
                </li>
               
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                   
                    aria-expanded="false"
                  >
                    <div class="avatar-sm">
                      <img
                        src="../assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold"><?php echo $_SESSION['name']; ?></span>
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>