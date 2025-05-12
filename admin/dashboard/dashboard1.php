<?php
include("../common/menu.php");
include("../connection.php");

$sel33=mysqli_query($con,"select * from child where id='$_SESSION[uid]'");
$row33=mysqli_fetch_array($sel33);
?>

<style>
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: black; /* Set the background color to black */
    border-radius: 50%; /* Optional: Add a circular shape */
  }
  
  .pdiv{
	  background-color: #5d71e1;
    color: white;
    padding: 20px;
    border-radius: 15px;
  }
  .img{
	      width: 214px;
    margin-top: -189px;
    margin-left: 740px;
  }

</style>


<div class="container">
  <div class="page-inner">
    <br><br><br>
	<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 pdiv">
      <div>
        <h2 class="fw-bold mb-3">Hi <?php echo $_SESSION['name']; ?> !!!</h2>
        <h6 class="op-7 mb-2">Welcome to Autisync</h6>
		<img src="images/profile.png" class="img">
      </div>
    </div> <br>
	
	

    <div class="row">
      <div class="col-md-6">
        <!-- Card 1 -->
        
        <!-- Carousel -->
        <div class="card">
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
								echo '<form method="POST" action="">';
								echo '<input type="hidden" name="task_id" value="' . $row['id'] . '">';
								echo '<button type="submit" name="mark_done" class="btn btn-primary">Mark as done</button>';
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
                  <span class="carousel-control-prev-icon" aria-hidden="true" style="margin-left: -53px;"></span>
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
	  
	  <?php
if (isset($_POST['mark_done'])) {
    $task_id = $_POST['task_id'];

    // Update the status to "completed"
    $update_query = "UPDATE routine SET status = 'completed' WHERE id = '$task_id' AND date = '$date'";
    
    if (mysqli_query($con, $update_query)) {
        // Reload the page to reflect the updated status
        echo "<script>window.location.href = 'dashboard1.php';</script>";
    } else {
        echo "<script>alert('Error updating status');</script>";
    }
}
?>
	  
	  
	  <div class="col-md-6" style="min-height: 510px;">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Routine Calender</div>
          </div>
          <div class="card-body">
            <!-- Calendar Section -->
			<?php
			// Get the selected date or default to the current date
			$selected_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

			// Fetch routines for the selected date
			$sql = "SELECT time, task, status FROM routine WHERE date = ?";
			$stmt = $con->prepare($sql);
			$stmt->bind_param("s", $selected_date);
			$stmt->execute();
			$result = $stmt->get_result();

			$routines = [];
			while ($row = $result->fetch_assoc()) {
				$routines[] = $row;
			}
			
			?>
			<form method="get">
				<input type="date" id="date" name="date" class="form-control" value="<?php echo $selected_date; ?>" onchange="this.form.submit();">
			</form>
			
			<br>
			<table class="table ">
              <!-- Example Progress -->
			    <thead>
					<tr>
						<th>Time</th>
						<th>Task</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($routines)) : ?>
						<?php foreach ($routines as $routine) : ?>
							<tr>
								<td><?php echo date("g:i A", strtotime($routine['time'])); ?></td>
								<td><?php echo $routine['task']; ?></td>
								<td>
									<span class="badge badge-<?php echo strtolower($routine['status']) === 'completed' ? 'success' : 'danger'; ?>">
										<?php echo ucfirst($routine['status']); ?>
									</span>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="3" class="text-center">No routines found for this date.</td>
						</tr>
					<?php endif; ?>
				</tbody>
            </table>
          </div>
        </div>
      </div>
      </div> 
      <!-- Card 2 -->
      <div class="col-md-6" style="    margin-top: -175px;">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Active Courses</div>
          </div>
          <div class="card-body">
            <table class="table ">
              <!-- Example Progress -->
              <?php
				if($row33['level']==0)
				{

			  ?>
			  <tr>
                <div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 570px;">
					<!-- Left Image Section -->
					<img src="images/speech.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

					<!-- Right Content Section -->
					<div style="flex: 1;">
						<h5 style="margin: 0; font-weight: bold;">Image Recognition </h5>
						<p class="text-muted" style="margin: 5px 0; color: gray;">All Customs Value</p>
						
						<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
							<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Languages</span>
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
                <div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 570px;">
					<!-- Left Image Section -->
					<img src="images/music.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

					<!-- Right Content Section -->
					<div style="flex: 1;">
						<h5 style="margin: 0; font-weight: bold;">Image Puzzle</h5>
						<p class="text-muted" style="margin: 5px 0; color: gray;">All Customs Value</p>
						
						<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
							<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Languages</span>
							<span><b>Start:</b> 20 July</span>
						</div>
					</div>

					<!-- View More Button -->
					<a href="../courses/image_puzzle.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
						View More
					</a>
				</div>
              </tr>
			  <hr>
			  
			  <?php
				}elseif($row33['level']==1)
				{
			  ?>
			  
			  <tr>
                <div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 570px;">
					<!-- Left Image Section -->
					<img src="images/music.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

					<!-- Right Content Section -->
					<div style="flex: 1;">
						<h5 style="margin: 0; font-weight: bold;">Speech Therapy</h5>
						<p class="text-muted" style="margin: 5px 0; color: gray;">All Customs Value</p>
						
						<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
							<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Languages</span>
							<span><b>Start:</b> 20 July</span>
						</div>
					</div>

					<!-- View More Button -->
					<a href="../courses/language.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
						View More
					</a>
				</div>
              </tr>
			  <hr>
			  
			  <tr>
                <div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 570px;">
					<!-- Left Image Section -->
					<img src="images/music.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

					<!-- Right Content Section -->
					<div style="flex: 1;">
						<h5 style="margin: 0; font-weight: bold;">Writing Test</h5>
						<p class="text-muted" style="margin: 5px 0; color: gray;">All Customs Value</p>
						
						<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
							<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Languages</span>
							<span><b>Start:</b> 20 July</span>
						</div>
					</div>

					<!-- View More Button -->
					<a href="../courses/write.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
						View More
					</a>
				</div>
              </tr>
			  <hr>
			  
			  <?php
				}elseif($row33['level']==2)
				{
				?>
			  
			  <tr>
                <div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 570px;">
					<!-- Left Image Section -->
					<img src="images/music.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

					<!-- Right Content Section -->
					<div style="flex: 1;">
						<h5 style="margin: 0; font-weight: bold;">Understanding Emotions</h5>
						<p class="text-muted" style="margin: 5px 0; color: gray;">All Customs Value</p>
						
						<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
							<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Languages</span>
							<span><b>Start:</b> 20 July</span>
						</div>
					</div>

					<!-- View More Button -->
					<a href="../courses/language.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
						View More
					</a>
				</div>
              </tr>
			  <hr>
			  
			  <tr>
                <div style="display: flex; align-items: center; background-color: antiquewhite; padding: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 570px;">
					<!-- Left Image Section -->
					<img src="images/music.png" alt="Speech Therapy" style="width: 100px; border-radius: 15px; margin-right: 15px;">

					<!-- Right Content Section -->
					<div style="flex: 1;">
						<h5 style="margin: 0; font-weight: bold;">Social Situations</h5>
						<p class="text-muted" style="margin: 5px 0; color: gray;">All Customs Value</p>
						
						<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
							<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Languages</span>
							<span><b>Start:</b> 20 July</span>
						</div>
					</div>

					<!-- View More Button -->
					<a href="../courses/language.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold; cursor: pointer;">
						View More
					</a>
				</div>
              </tr>
			  <hr>
			  
			  <?php
			  }
			  ?>
			  
			  
			  
			  
              <hr>
              <!-- Repeat as needed -->
			  <center><a href="../courses/courses.php">View all</a></center>
            </table>
          </div>
        </div>
      </div>
    </div>
   
 
</div>





<?php
include("../common/footer.php");
?>
