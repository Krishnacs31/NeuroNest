<?php
include("../common/menu.php");
include("../connection.php");


$user_id = $_SESSION['uid'];

$sel = mysqli_query($con, "SELECT * FROM child WHERE parent_id='$_SESSION[uid]'");
$row = mysqli_fetch_array($sel);

$user_level = $row['level'];

// Define tables based on user level
$tables1 = [];
if ($user_level == "Beginner (Basic Recognition & Interaction)") {
    $tables1 = ["image_rec_score", "image_puzzle_score", "music_therapy_score"];
} elseif ($user_level == "Intermediate (Cognitive & Motor Skill Development)") {
    $tables1 = ["speech_therapy_score", "writing_test_score", "cloth_score"];
} elseif ($user_level == "Advanced (Logical Thinking & Social Skills)") {
    $tables1 = ["emotion_score", "social_score", "manners_score"];
}

// Fetch scores for each activity
$activity_scores = [];
foreach ($tables1 as $tablex) {
    $query = "SELECT SUM(score) AS total_score FROM $tablex WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Use isset() instead of ??
    $activity_scores[$tablex] = isset($row['total_score']) ? $row['total_score'] : 0;
}

// Convert data to JSON for JavaScript
echo "<script>var activityData = " . json_encode($activity_scores) . ";</script>";

?>

<style>
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: black; /* Set the background color to black */
    border-radius: 50%; /* Optional: Add a circular shape */
  }
  .pdiv {
    background-color: #d5c0f1;
    color: white;
    padding: 20px;
    border-radius: 15px;
    position: relative;
  }
  .img {
    position: absolute;
    top: -75px; /* Adjust to move it over the div */
    right: 75px; /* Change to move it anywhere */
    width: 327px; /* Adjust size */
    height: auto;
    z-index: 10; /* Ensure it stays above */
  }
  /* Chatbot Modal Styles */
  .chatbot-modal {
    display: none; /* Hidden by default */
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 400px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    z-index: 1000; /* Ensure it stays on top */
  }
  .chat-header {
    background-color:rgb(30, 78, 130);
    color: #fff;
    padding: 15px;
    text-align: center;
    font-size: 18px;
  }
  .chat-messages {
    height: 300px;
    padding: 15px;
    overflow-y: auto;
    border-bottom: 1px solid #ddd;
  }
  .message {
    margin-bottom: 15px;
  }
  .message.user {
    text-align: right;
  }
  .message.bot {
    text-align: left;
  }
  .message p {
    display: inline-block;
    padding: 10px;
    border-radius: 10px;
    max-width: 80%;
  }
  .user p {
    background-color: #007bff;
    color: #fff;
  }
  .bot p {
    background-color: #f1f1f1;
    color: #333;
  }
  .chat-input {
    display: flex;
	padding: 10px;
  }
  .chat-input input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
  }
  .chat-input button {
    margin-left: 10px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  .chat-input button:hover {
    background-color: #0056b3;
  }
  .chatbot-toggle {
    position: fixed;
    bottom: 20px;
	right: 20px;
    background-color: #007bff;
    color: #fff;
    padding: 15px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 1000; /* Ensure it stays on top */
  }
</style>
		
		<div class="container">
          <div class="page-inner">
			<h2>Child's Assessment Overview</h2>
			
			<div class="row">
              
			  
			  <div class="col-sm-6 col-md-6">
				<div class="card card-stats card-round" style="background-color: #ccffb8;">
                  <div class="card-body" style="height:380px">
                    <div class="row align-items-center">
                      
					  <canvas id="scoreChart"></canvas>
					  
                    </div>
                  </div>
                </div>
              </div>
			  
			  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let activityNames = Object.keys(activityData).map(name => name.replace("_score", "").replace("_", " "));
    let activityScores = Object.values(activityData);

    let ctx = document.getElementById("scoreChart").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: activityNames,
            datasets: [{
                label: "Attempt Score",
                data: activityScores,
                backgroundColor: ["#FF5733", "#33FF57", "#3357FF", "#FFC300", "#C70039", "#900C3F"],
                borderColor: "#333",
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 1,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>

			  
			  <div class="col-sm-6 col-md-6">
				<div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center" style="padding:20px;">
                      <?php
					$sel = mysqli_query($con, "SELECT * FROM child WHERE parent_id='$_SESSION[uid]'");
$row = mysqli_fetch_array($sel);

					if ($row['level'] == 'Advanced (Logical Thinking & Social Skills)') {
						$level = 'Advanced (Logical Thinking & Social Skills)';
						$badgeClass = 'bg-success';
						$content="Your child is currently at the Advanced level, showcasing strong logical thinking 
						and social skills. They are becoming more independent in problem-solving and displaying an 
						enhanced ability to communicate and collaborate. Encouraging group activities, critical thinking 
						exercises, and real-world problem-solving tasks will help maintain their development and prepare 
						them for more complex challenges.";						
					} elseif ($row['level'] == 'Intermediate (Cognitive & Motor Skill Development)') {
						$level = 'Intermediate (Cognitive & Motor Skill Development)';
						$badgeClass = 'bg-warning'; 
						$content="Your child is currently at the Intermediate level, demonstrating progress in 
						cognitive and motor skill development. This stage focuses on refining problem-solving abilities, 
						hand-eye coordination, and memory retention. Engaging in structured activities, such as puzzles, 
						guided storytelling, and interactive games, will enhance their learning experience and support 
						continued growth.";
					} elseif ($row['level'] == 'Beginner (Basic Recognition & Interaction)') {
						$level = 'Beginner (Basic Recognition & Interaction)';
						$badgeClass = 'bg-danger';
						$content="Your child is currently at the Beginner level, developing fundamental 
						recognition and interaction skills. At this stage, it is essential to engage in 
						activities that focus on basic sensory stimulation, pattern recognition, and interactive 
						learning. Encouraging hands-on experiences and repetition will help reinforce foundational 
						concepts and build confidence.";
					}
					?>

					<h4>Assessment Level - <span class="badge <?php echo $badgeClass; ?>"><?php echo $level; ?></span></h4>
					  
					  <p><?php echo $content; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			
			<div class="row">
			
			<?php
			if ($row['level'] == 'Beginner (Basic Recognition & Interaction)') {
				?>
			<!-- level -->
			
			  <div class="col-sm-6 col-md-4">
				<a href="../courses/image_recognition.php">
					<div class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<!-- Left Image Section -->
								<div class="col-icon">
									<img src="images/Image_Recognition.png" alt="Image Recognition" style="width: 80px; border-radius: 15px;">
								</div>

								<!-- Right Content Section -->
								<div class="col col-stats ms-3 ms-sm-0">
									<div class="numbers">
										<h5 style="margin: 0; font-weight: bold;">Image Recognition</h5>
										<p class="text-muted" style="margin: 5px 0; color: gray;">Learn to recognize objects, animals, and colors through fun activities!</p>
										
										<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
											<span style="background-color: #1572e8; margin-left: 165px; color:white; padding: 5px 10px; border-radius: 4px;">View More</span>
											<span><b></b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<div class="col-sm-6 col-md-4">
				<a href="../courses/image_puzzle.php">
					<div class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<!-- Left Image Section -->
								<div class="col-icon">
									<img src="images/puzzle.png" alt="Image Recognition" style="width: 80px; border-radius: 15px;">
								</div>

								<!-- Right Content Section -->
								<div class="col col-stats ms-3 ms-sm-0">
									<div class="numbers">
										<h5 style="margin: 0; font-weight: bold;">Image Puzzle</h5>
										<p class="text-muted" style="margin: 5px 0; color: gray;">Solve fun picture puzzles and improve your thinking skills!</p>
										
										<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
											<span style="background-color: #1572e8; margin-left: 165px; color:white; padding: 5px 10px; border-radius: 4px;">View More</span>
											<span><b></b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<div class="col-sm-6 col-md-4">
				<a href="../courses/music_therapy.php">
					<div class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<!-- Left Image Section -->
								<div class="col-icon">
									<img src="images/music.png" alt="Image Recognition" style="width: 80px; border-radius: 15px;">
								</div>

								<!-- Right Content Section -->
								<div class="col col-stats ms-3 ms-sm-0">
									<div class="numbers">
										<h5 style="margin: 0; font-weight: bold;">Music Therapy</h5>
										<p class="text-muted" style="margin: 5px 0; color: gray;">Enjoy soothing melodies and interactive music activities for relaxation and learning!</p>
										
										<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
											<span style="background-color: #1572e8; margin-left: 165px; color:white; padding: 5px 10px; border-radius: 4px;">View More</span>
											<span><b></b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<!-- level end -->
			<?php
			} elseif ($row['level'] == 'Intermediate (Cognitive & Motor Skill Development)') {
			?>
			<!-- level -->
			
			  <div class="col-sm-6 col-md-4">
				<a href="../courses/language.php">
					<div class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<!-- Left Image Section -->
								<div class="col-icon">
									<img src="images/speech.png" alt="Image Recognition" style="width: 80px; border-radius: 15px;">
								</div>

								<!-- Right Content Section -->
								<div class="col col-stats ms-3 ms-sm-0">
									<div class="numbers">
										<h5 style="margin: 0; font-weight: bold;">Speech Therapy</h5>
										<p class="text-muted" style="margin: 5px 0; color: gray;">Practice words and sounds through fun and interactive speaking exercises!</p>
										
										<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
											<span style="background-color: #1572e8; margin-left: 165px; color:white; padding: 5px 10px; border-radius: 4px;">View More</span>
											<span><b></b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<div class="col-sm-6 col-md-4">
				<a href="../courses/write.php">
					<div class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<!-- Left Image Section -->
								<div class="col-icon">
									<img src="images/write.png" alt="Image Recognition" style="width: 80px; border-radius: 15px;">
								</div>

								<!-- Right Content Section -->
								<div class="col col-stats ms-3 ms-sm-0">
									<div class="numbers">
										<h5 style="margin: 0; font-weight: bold;">Writing Test</h5>
										<p class="text-muted" style="margin: 5px 0; color: gray;">Improve handwriting and spelling with fun writing exercises!</p>
										
										<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
											<span style="background-color: #1572e8; margin-left: 165px; color:white; padding: 5px 10px; border-radius: 4px;">View More</span>
											<span><b></b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<div class="col-sm-6 col-md-4">
				<a href="../courses/clothing.php">
					<div class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<!-- Left Image Section -->
								<div class="col-icon">
									<img src="images/cloth.png" alt="Image Recognition" style="width: 80px; border-radius: 15px;">
								</div>

								<!-- Right Content Section -->
								<div class="col col-stats ms-3 ms-sm-0">
									<div class="numbers">
										<h5 style="margin: 0; font-weight: bold;">Choosing the Right Clothing</h5>
										<p class="text-muted" style="margin: 5px 0; color: gray;">Learn to pick the perfect outfit for different seasons and occasions!</p>
										
										<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
											<span style="background-color: #1572e8; margin-left: 165px; color:white; padding: 5px 10px; border-radius: 4px;">View More</span>
											<span><b></b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<!-- level end -->
			<?php
			} elseif ($row['level'] == 'Advanced (Logical Thinking & Social Skills)') {
			?>
			<!-- level -->
			
			  <div class="col-sm-6 col-md-4">
				<a href="../courses/emotions.php">
					<div class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<!-- Left Image Section -->
								<div class="col-icon">
									<img src="images/emotions.png" alt="Image Recognition" style="width: 80px; border-radius: 15px;">
								</div>

								<!-- Right Content Section -->
								<div class="col col-stats ms-3 ms-sm-0">
									<div class="numbers">
										<h5 style="margin: 0; font-weight: bold;">Understanding Emotions</h5>
										<p class="text-muted" style="margin: 5px 0; color: gray;">Explore different feelings and learn how to express them in a healthy way!</p>
										
										<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
											<span style="background-color: #1572e8; margin-left: 165px; color:white; padding: 5px 10px; border-radius: 4px;">View More</span>
											<span><b></b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<div class="col-sm-6 col-md-4">
				<a href="../courses/situation.php">
					<div class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<!-- Left Image Section -->
								<div class="col-icon">
									<img src="images/Social.png" alt="Image Recognition" style="width: 80px; border-radius: 15px;">
								</div>

								<!-- Right Content Section -->
								<div class="col col-stats ms-3 ms-sm-0">
									<div class="numbers">
										<h5 style="margin: 0; font-weight: bold;">Social Situations</h5>
										<p class="text-muted" style="margin: 5px 0; color: gray;">Learn how to interact with others, share, and make friends in different situations!</p>
										
										<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
											<span style="background-color: #1572e8; margin-left: 165px; color:white; padding: 5px 10px; border-radius: 4px;">View More</span>
											<span><b></b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<div class="col-sm-6 col-md-4">
				<a href="../courses/manners.php">
					<div class="card card-stats card-round">
						<div class="card-body">
							<div class="row align-items-center">
								<!-- Left Image Section -->
								<div class="col-icon">
									<img src="images/manners.png" alt="Image Recognition" style="width: 80px; border-radius: 15px;">
								</div>

								<!-- Right Content Section -->
								<div class="col col-stats ms-3 ms-sm-0">
									<div class="numbers">
										<h5 style="margin: 0; font-weight: bold;">Social Manners Scenarios</h5>
										<p class="text-muted" style="margin: 5px 0; color: gray;">Practice good manners and polite behavior in everyday situations!</p>
										
										<div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
											<span style="background-color: #1572e8; margin-left: 165px; color:white; padding: 5px 10px; border-radius: 4px;">View More</span>
											<span><b></b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
			<!-- level end -->

			<?php }?>
			  
            </div>
			
			


			
		
        </div>
		


<?php
include("../common/footer.php");
?>