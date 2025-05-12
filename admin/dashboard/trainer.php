<?php
include("../common/menu.php");
include("../connection.php");
?>

<style>
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: black; /* Set the background color to black */
    border-radius: 50%; /* Optional: Add a circular shape */
  }
  .pdiv{
	  background-color: #cae3f9;
    color: white;
    padding: 20px;
    border-radius: 15px;
	position: relative;
	
  }
  .img{
	position: absolute;
    top: -150px; /* Adjust to move it over the div */
    right: 75px; /* Change to move it anywhere */
    width: 327px; /* Adjust size */
    height: auto;
    z-index: 10; /* Ensure it stays above */
  }
</style>
		
		<div class="container">
          <div class="page-inner">
		   <br><br><br><br><br><br>
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 pdiv">
			  <div style="padding:20px;">
				<h2 class="fw-bold mb-3" style="color:black;">Hi <?php echo $_SESSION['name']; ?> !!!</h2>
				<h6 class="op-7 mb-2" style="color:black;">Guide, support, and inspire lets make a difference together! </h6>
				<img src="images/profile2.png" class="img">
			  </div>
			</div> <br>
			
			<div class="row">
              
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../trainer/profile.php">
				<div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category"></p>
                          <h4 class="card-title">Profile</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../child/select.php">
				<div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category"></p>
                          <h4 class="card-title">Manage Childs</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../courses/courses1.php">
				<div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category"></p>
                          <h4 class="card-title">Activities</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../booking/select.php">
				<div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category"></p>
                          <h4 class="card-title">Booking</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../payment/select.php">
				<div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category"></p>
                          <h4 class="card-title">Payments</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../chat/select.php">
				<div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category"></p>
                          <h4 class="card-title">Trainer Chat</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			 
			  
			  
            </div>
			

			
		
        </div>
		
		

		
		
		

<?php
include("../common/footer.php");
?>
