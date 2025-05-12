<?php
include("../common/menu.php");
include("../connection.php");

$sel1=mysqli_query($con,"select * from child where parent_id='$_SESSION[uid]'");
$row1=mysqli_fetch_array($sel1);
?>

<style>
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: black; /* Set the background color to black */
    border-radius: 50%; /* Optional: Add a circular shape */
  }
  .pdiv{
	  background-color: #d5c0f1;
    color: white;
    padding: 20px;
    border-radius: 15px;
	position: relative;
	
  }
  .img{
	position: absolute;
    top: -75px; /* Adjust to move it over the div */
    right: 75px; /* Change to move it anywhere */
    width: 327px; /* Adjust size */
    height: auto;
    z-index: 10; /* Ensure it stays above */
  }
</style>
		
		<div class="container">
          <div class="page-inner">
		   <br><br><br>
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 pdiv">
			  <div style="padding:20px;">
				<h2 class="fw-bold mb-3" style="color:black;">Hi <?php echo $_SESSION['name']; ?> !!!</h2>
				<h6 class="op-7 mb-2" style="color:black;">Efficiently manage your students and provide the best support for your children.</h6>
				<img src="images/profile1.png" class="img">
			  </div>
			</div> <br>
			
			<div class="row">
              
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../routine/select.php">
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
                          <h4 class="card-title">Child Routine</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../courses/courses.php">
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
                <a href="../trainer/select1.php">
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
                          <h4 class="card-title">Trainer Booking</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
			  
			  <div class="col-sm-6 col-md-3">
                <a href="../chat/select1.php">
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
                          <h4 class="card-title">Child Profile</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				</a>
              </div>
            </div>
			
			<div class="col-md-12" >
			   <div class="card">
				  <div class="card-header">
					 <div class="card-title">Child Routines</div>
				  </div>
				  <div class="card-body">
					 <div class="card-head-row card-tools-still-right">
						<div class="card-title">Today's Routine (<span style="color: #8898aa;"><?php echo date('Y-m-d')?></span>)</div>
					 </div>
					 <br>
					 <div class="table-responsive">
						<div id="incomeCarousel" class="carousel slide" data-bs-ride="carousel">
						   <div class="carousel-inner">
							  <?php
								 $date=date('Y-m-d');
								 $sel = mysqli_query($con, "SELECT * FROM routine WHERE date = '$date'");
								 if (mysqli_num_rows($sel) > 0) {
								 $isActive = true;
								 $rows = [];
								 while ($row = mysqli_fetch_array($sel)) {
								  $rows[] = $row;
								 }
								 
								 for ($i = 0; $i < count($rows); $i += 2) {
								  echo $isActive ? '<div class="carousel-item active">' : '<div class="carousel-item">';
								  echo '<div class="row">';
								  
								  for ($j = 0; $j < 2; $j++) {
									if (isset($rows[$i + $j])) {
									  $row = $rows[$i + $j];
									  echo '<div class="col-12 col-sm-6 col-md-6 col-xl-6">';
									  echo '<div class="card">';
									  echo '<div class="card-body" style="height:199px;">';
									  echo '<div class="d-flex justify-content-between">';
									  echo '<div>'; 
									  echo '<h5><b>' . htmlspecialchars($row['task']) . '</b></h5>';
									  
									  echo '</div>';
									  $time = date("g:i A", strtotime($row['time']));
									  echo '<img src="../routine/uploads/' . $row['image'] . '" alt="Routine Image" style="width:100px; height:100px;">';
									  echo '<h4 class="text-info fw-bold">' . htmlspecialchars($time) . '</h4>';
									  echo '</div>';
									  
									  echo '<div class="d-flex justify-content-between mt-2">';
									  if ($row['status'] === 'completed') {
										echo '<span class="badge badge-success">' . $row['status'] . '</span>';
									  }else {
echo '<form method="POST" action="" style="display: flex; justify-content: center; margin-top: 10px;">';
echo '<input type="hidden" name="task_id" value="' . $row['id'] . '">';
echo '<button type="submit" name="mark_done" class="btn btn-primary" style="margin-left: 260px;"><i class="fas fa-check-square"></i></button>';
echo '</form>';

									}
									  
									  echo '</div>';
									  echo '</div>';
									  echo '</div>';
									  echo '</div>';
									}
								  }
								  
								  echo '</div>'; 
								  echo '</div>';
								  $isActive = false;
								 }
								 } else {
								 echo '<div class="carousel-item active">';
								 echo '<div class="row">';
								 echo '<div class="col-12">';
								 echo '<div class="card">';
								 echo '<div class="card-body text-center">No routine available</div>';
								 echo '</div>';
								 echo '</div>';
								 echo '</div>';
								 echo '</div>';
								 }
								 ?>
						   </div>
						   <!-- Carousel Controls -->
						   <button class="carousel-control-prev" type="button" data-bs-target="#incomeCarousel" data-bs-slide="prev">
						   <span class="carousel-control-prev-icon" aria-hidden="true" style="margin-left: 0px;"></span>
						   <span class="visually-hidden">Previous</span>
						   </button>
						   <button class="carousel-control-next" type="button" data-bs-target="#incomeCarousel" data-bs-slide="next">
						   <span class="carousel-control-next-icon" aria-hidden="true" style="margin-right: -53px;"></span>
						   <span class="visually-hidden">Next</span>
						   </button>
						</div>
					 </div>
				  </div>
			   </div>
			</div>

			
			

			
			
			<div class="col-md-12" >
				<div class="card">
				  <div class="card-header">
					<div class="card-title">Active Courses</div>
				  </div>
				  <div class="card-body">
					<table class="table ">
					  <!-- Example Progress -->
					  <?php if($row1['level']=='Beginner (Basic Recognition & Interaction)'){ ?> 
					  <tr>
						<div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 1140px;">
							<!-- Left Image Section -->
							<img src="images/speech.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

							<!-- Right Content Section -->
							<div style="flex: 1;">
								<h5 style="margin: 0; font-weight: bold;">Image Recognition</h5>
								<p class="text-muted" style="margin: 5px 0; color: gray;">Analyze and Identify Images</p>
								
								<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
									<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 1</span>
									<span><b></b> </span>
								</div>
							</div>

							<!-- View More Button -->
							<a href="../courses/image_recognition.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
								View More
							</a>
						</div>
					  </tr>
					  <hr>
					  
					  <tr>
						<div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 1140px;">
							<!-- Left Image Section -->
							<img src="images/puzzle.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

							<!-- Right Content Section -->
							<div style="flex: 1;">
								<h5 style="margin: 0; font-weight: bold;">Image Puzzle</h5>
								<p class="text-muted" style="margin: 5px 0; color: gray;">Solve interactive image puzzles to enhance recognition skills.</p>
								
								<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
									<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 1</span>
									<span></span>
								</div>
							</div>

							<!-- View More Button -->
							<a href="../courses/image_puzzle.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
								View More
							</a>
						</div>
					  </tr><hr>
					  <?php }elseif($row1['level']=='Intermediate (Cognitive & Motor Skill Development)'){ ?>
					  
					  <tr>
						<div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 1140px;">
							<!-- Left Image Section -->
							<img src="images/speech.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

							<!-- Right Content Section -->
							<div style="flex: 1;">
								<h5 style="margin: 0; font-weight: bold;">Speech Therapy</h5>
								<p class="text-muted" style="margin: 5px 0; color: gray;">Enhance communication skills through guided speech exercises and interactive sessions.</p>
								
								<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
									<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 2</span>
									<span></span>
								</div>
							</div>

							<!-- View More Button -->
							<a href="../courses/language.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
								View More
							</a>
						</div>
					  </tr><hr>
					  
					  <tr>
						<div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 1140px;">
							<!-- Left Image Section -->
							<img src="images/write.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

							<!-- Right Content Section -->
							<div style="flex: 1;">
								<h5 style="margin: 0; font-weight: bold;">Writing Test</h5>
								<p class="text-muted" style="margin: 5px 0; color: gray;">Assess and improve writing skills through engaging exercises and evaluations.</p>
								
								<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
									<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 2</span>
									<span></span>
								</div>
							</div>

							<!-- View More Button -->
							<a href="../courses/write.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
								View More
							</a>
						</div>
					  </tr><hr>
					  <?php }elseif($row1['level']=='Advanced (Logical Thinking & Social Skills)'){ ?>
					  
					  <tr>
						<div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 1140px;">
							<!-- Left Image Section -->
							<img src="images/emotions.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

							<!-- Right Content Section -->
							<div style="flex: 1;">
								<h5 style="margin: 0; font-weight: bold;">Understanding Emotions</h5>
								<p class="text-muted" style="margin: 5px 0; color: gray;">Learn to recognize and express emotions through interactive activities.</p>
								
								<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
									<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 3</span>
									<span></span>
								</div>
							</div>

							<!-- View More Button -->
							<a href="../courses/emotions.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
								View More
							</a>
						</div>
					  </tr><hr>
					  
					  <tr>
						<div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 1140px;">
							<!-- Left Image Section -->
							<img src="images/Social.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

							<!-- Right Content Section -->
							<div style="flex: 1;">
								<h5 style="margin: 0; font-weight: bold;">Social Situations</h5>
								<p class="text-muted" style="margin: 5px 0; color: gray;">Develop social skills by exploring real-life scenarios and responses.</p>
								
								<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
									<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 3</span>
									<span></span>
								</div>
							</div>

							<!-- View More Button -->
							<a href="../courses/situation.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
								View More
							</a>
						</div>
					  </tr><hr>
					  <?php } ?>
					  
					  <!-- Repeat as needed -->
					  <center><a href="../courses/courses.php">View all</a></center>
					</table>
				  </div>
				</div>
			 </div>
			
		
        </div>
		
		

		
		
		

<?php
include("../common/footer.php");
?>
