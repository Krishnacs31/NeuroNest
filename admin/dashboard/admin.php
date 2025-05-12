<?php
include("../common/menu.php");
include("../connection.php");

$sel = mysqli_query($con, "SELECT COUNT(*) AS child_count FROM `child`");
$row = mysqli_fetch_array($sel);
$child_count = $row['child_count'];

// Count parents
$sel1 = mysqli_query($con, "SELECT COUNT(*) AS parent_count FROM `parent`");
$row1 = mysqli_fetch_array($sel1);
$parent_count = $row1['parent_count'];
?>

<style>
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: black; /* Set the background color to black */
    border-radius: 50%; /* Optional: Add a circular shape */
  }
</style>
		
		<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Welcome <?php echo $_SESSION['user']; ?> !!!</h3>
                <h6 class="op-7 mb-2"></h6>
              </div>
            </div>
			
			<div class="row">
              
			  <div class="col-sm-6 col-md-3">
                <a href="../trainer/select.php">
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
                          <h4 class="card-title">Trainers</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../parent/select.php">
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
                          <h4 class="card-title">Parents</h4>
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
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                          <i class="fas fa-user-check"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category"></p>
                          <h4 class="card-title">Child</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			  <!--
			  <div class="col-sm-6 col-md-3">
                <a href="../image_recognition/select.php">
				<div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                          <i class="fas fa-search"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category"></p>
						  <h4 class="card-title">Image Recognition</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div> -->
			  
			  
			  
            </div>
			
          </div>
        </div>
		
		

		
		
		

<?php
include("../common/footer.php");
?>
