<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");

$sel=mysqli_query($con,"select * from child where id='$_SESSION[uid]'");
$row=mysqli_fetch_array($sel);

?>





<div class="container">
	<div class="page-inner">
		
		<div class="row">
              <?php if($row['level']=='Beginner (Basic Recognition & Interaction)') { ?>		  
			  <div class="col-sm-6 col-md-4">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; max-width: 400px;">
					<!-- Image Section -->
					<img src="../dashboard/images/Image_Recognition.png" alt="Speech Therapy" style="width: 100%; height: auto;">

					<!-- Content Section -->
					<a  style="text-decoration: none; color: inherit;">
						<div class="card-body" style="padding: 15px;">
							<h4 class="card-title" style="font-weight: bold; margin: 0;">Image Recognition</h4>
							<p class="text-muted" style="margin-top: 5px;">Language lessons with the most popular teachers</p>
							
							<div style="display: flex; gap: 10px; margin-top: 10px;">
								<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 1</span>
								
							</div>
						</div>
					</a>

					<!-- Footer Section with Button -->
					<div class="card-footer" style="text-align: right; padding: 15px; background-color: white; border-top: none;">
						<a href="image_recognition.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold;">
							Start
						</a>
					</div>
				</div>
              </div>
			  
			  <div class="col-sm-6 col-md-4">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; max-width: 400px;">
					<!-- Image Section -->
					<img src="../dashboard/images/puzzle.png" alt="Speech Therapy" style="width: 100%; height: auto;">

					<!-- Content Section -->
					<a  style="text-decoration: none; color: inherit;">
						<div class="card-body" style="padding: 15px;">
							<h4 class="card-title" style="font-weight: bold; margin: 0;">Image Puzzle</h4>
							<p class="text-muted" style="margin-top: 5px;">Language lessons with the most popular teachers</p>
							
							<div style="display: flex; gap: 10px; margin-top: 10px;">
								<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 1</span>
								
							</div>
						</div>
					</a>

					<!-- Footer Section with Button -->
					<div class="card-footer" style="text-align: right; padding: 15px; background-color: white; border-top: none;">
						<a href="image_puzzle.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold;">
							Start
						</a>
					</div>
				</div>
              </div>
			  
			  
			  <div class="col-sm-6 col-md-4">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; max-width: 400px;">
					<!-- Image Section -->
					<img src="../dashboard/images/music.png" alt="Speech Therapy" style="width: 100%; height: auto;">

					<!-- Content Section -->
					<a  style="text-decoration: none; color: inherit;">
						<div class="card-body" style="padding: 15px;">
							<h4 class="card-title" style="font-weight: bold; margin: 0;">Music Therapy</h4>
							<p class="text-muted" style="margin-top: 5px;">Language lessons with the most popular teachers</p>
							
							<div style="display: flex; gap: 10px; margin-top: 10px;">
								<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 1</span>
							
							</div>
						</div>
					</a>

					<!-- Footer Section with Button -->
					<div class="card-footer" style="text-align: right; padding: 15px; background-color: white; border-top: none;">
						<a href="music_therapy.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold;">
							Start
						</a>
					</div>
				</div>
              </div>
			  <?php }elseif($row['level']=='Intermediate (Cognitive & Motor Skill Development)'){ ?>
			  
			  <div class="col-sm-6 col-md-4">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; max-width: 400px;">
					<!-- Image Section -->
					<img src="../dashboard/images/speech.png" alt="Speech Therapy" style="width: 100%; height: auto;">

					<!-- Content Section -->
					<a  style="text-decoration: none; color: inherit;">
						<div class="card-body" style="padding: 15px;">
							<h4 class="card-title" style="font-weight: bold; margin: 0;">Speech Therapy</h4>
							<p class="text-muted" style="margin-top: 5px;">Language lessons with the most popular teachers</p>
							
							<div style="display: flex; gap: 10px; margin-top: 10px;">
								<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 2</span>
								
							</div>
						</div>
					</a>

					<!-- Footer Section with Button -->
					<div class="card-footer" style="text-align: right; padding: 15px; background-color: white; border-top: none;">
						<a href="language.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold;">
							Start
						</a>
					</div>
				</div>
              </div>
			  
			  
			  
			  <div class="col-sm-6 col-md-4">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; max-width: 400px;">
					<!-- Image Section -->
					<img src="../dashboard/images/write.png" alt="Speech Therapy" style="width: 100%; height: auto;">

					<!-- Content Section -->
					<a  style="text-decoration: none; color: inherit;">
						<div class="card-body" style="padding: 15px;">
							<h4 class="card-title" style="font-weight: bold; margin: 0;">Writing Test</h4>
							<p class="text-muted" style="margin-top: 5px;">Language lessons with the most popular teachers</p>
							
							<div style="display: flex; gap: 10px; margin-top: 10px;">
								<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 2</span>
								
							</div>
						</div>
					</a>

					<!-- Footer Section with Button -->
					<div class="card-footer" style="text-align: right; padding: 15px; background-color: white; border-top: none;">
						<a href="write.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold;">
							Start
						</a>
					</div>
				</div>
              </div>
			 
			  
			  <div class="col-sm-6 col-md-4">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; max-width: 400px;">
					<!-- Image Section -->
					<img src="../dashboard/images/cloth.png" alt="Speech Therapy" style="width: 100%; height: auto;">

					<!-- Content Section -->
					<a  style="text-decoration: none; color: inherit;">
						<div class="card-body" style="padding: 15px;">
							<h4 class="card-title" style="font-weight: bold; margin: 0;">Choosing the Right Clothing</h4>
							<p class="text-muted" style="margin-top: 5px;">Language lessons with the most popular teachers</p>
							
							<div style="display: flex; gap: 10px; margin-top: 10px;">
								<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 2</span>
							
							</div>
						</div>
					</a>

					<!-- Footer Section with Button -->
					<div class="card-footer" style="text-align: right; padding: 15px; background-color: white; border-top: none;">
						<a href="clothing.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold;">
							Start
						</a>
					</div>
				</div>
              </div>
			  
			  <?php }elseif($row['level']=='Advanced (Logical Thinking & Social Skills)'){ ?>
			   
			  
			  <div class="col-sm-6 col-md-4">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; max-width: 400px;">
					<!-- Image Section -->
					<img src="../dashboard/images/emotions.png" alt="Speech Therapy" style="width: 100%; height: auto;">

					<!-- Content Section -->
					<a style="text-decoration: none; color: inherit;">
						<div class="card-body" style="padding: 15px;">
							<h4 class="card-title" style="font-weight: bold; margin: 0;">Understanding Emotions</h4>
							<p class="text-muted" style="margin-top: 5px;">Language lessons with the most popular teachers</p>
							
							<div style="display: flex; gap: 10px; margin-top: 10px;">
								<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 3</span>
							
							</div>
						</div>
					</a>

					<!-- Footer Section with Button -->
					<div class="card-footer" style="text-align: right; padding: 15px; background-color: white; border-top: none;">
						<a href="emotions.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold;">
							Start
						</a>
					</div>
				</div>
              </div>
			  
			  <div class="col-sm-6 col-md-4">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; max-width: 400px;">
					<!-- Image Section -->
					<img src="../dashboard/images/Social.png" alt="Speech Therapy" style="width: 100%; height: auto;">

					<!-- Content Section -->
					<a  style="text-decoration: none; color: inherit;">
						<div class="card-body" style="padding: 15px;">
							<h4 class="card-title" style="font-weight: bold; margin: 0;">Social Situations</h4>
							<p class="text-muted" style="margin-top: 5px;">Language lessons with the most popular teachers</p>
							
							<div style="display: flex; gap: 10px; margin-top: 10px;">
								<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 3</span>
							
							</div>
						</div>
					</a>

					<!-- Footer Section with Button -->
					<div class="card-footer" style="text-align: right; padding: 15px; background-color: white; border-top: none;">
						<a href="situation.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold;">
							Start
						</a>
					</div>
				</div>
              </div>
			  
			  <div class="col-sm-6 col-md-4">
                <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; max-width: 400px;">
					<!-- Image Section -->
					<img src="../dashboard/images/manners.png" alt="Speech Therapy" style="width: 100%; height: auto;">

					<!-- Content Section -->
					<a style="text-decoration: none; color: inherit;">
						<div class="card-body" style="padding: 15px;">
							<h4 class="card-title" style="font-weight: bold; margin: 0;">Social Manners Scenarios</h4>
							<p class="text-muted" style="margin-top: 5px;">Language lessons with the most popular teachers</p>
							
							<div style="display: flex; gap: 10px; margin-top: 10px;">
								<span style="background-color: #e9ecef; padding: 5px 10px; border-radius: 10px;">Level 3</span>
							
							</div>
						</div>
					</a>

					<!-- Footer Section with Button -->
					<div class="card-footer" style="text-align: right; padding: 15px; background-color: white; border-top: none;">
						<a href="manners.php" style="background-color: #f9a825; border: none; color: white; padding: 10px 15px; border-radius: 15px; text-decoration: none; font-weight: bold;">
							Start
						</a>
					</div>
				</div>
              </div>
			  
			  <?php } ?>
			  
			  
        </div>
		


<?php
	
	include("../footer_inner.php");
	?>