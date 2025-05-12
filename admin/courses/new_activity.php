<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");

$myfile1 = fopen("ML/a.txt", "w") or die("Unable to open file!");
							$txt1 = "0";
							fwrite($myfile1, $txt1);
							fclose($myfile1);

// Fetch the first random image
mysqli_query($con,"truncate table emotions");
    
?>

<style>
    .lyrics {
      margin: 20px auto;
      width: 80%;
      padding: 20px;
      border: 2px dashed #4CAF50;
      background-color: #e6f7ff;
      border-radius: 10px;
      text-align: left;
      font-size: 18px;
    }
    button {
      margin-top: 20px;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      border: none;
      border-radius: 5px;
      background-color: #4CAF50;
      color: white;
    }
    button:hover {
      background-color: #45a049;
    }
    audio {
      margin-top: 20px;
    }
  </style>


<div class="container">
	<div class="page-inner">
		<div class="row">
			<div class="col-sm-6 col-md-12">
				<div class="card card-stats card-round">
					<div class="card-body">
						<div class="text-center">
							<!-- Emotion Feedback Section -->
							<div class="emotion-box" id="emotionBox">
								<h2>It seems like you're not too interested right now...</h2>
								<p>Let's take a quick break to refresh! </p>
							</div>

							<!-- Break Activity Suggestions Section -->
							<div class="exercise-box" id="exerciseBox">
								<h3>Try these activities to relax:</h3>
								<button class="btn btn-success" onclick="startBreathingExercise()">Breathing Exercise</button>

								<div class="links mt-3">
									<h4>Or watch a fun cartoon!</h4>
									<a href="https://www.youtube.com/watch?v=5oH9Nr3bKfw" target="_blank" class="btn btn-primary">Watch Cartoon 1</a>
									<a href="https://www.youtube.com/watch?v=vzazRt5_ZGc" target="_blank" class="btn btn-primary mt-2">Watch Cartoon 2</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function startBreathingExercise() {
		window.location.href = "https://youtu.be/rRuqxR5oXJM?si=f3k6tghfoJ7Hj2sQ"; // Replace with your desired video URL
	}
</script>





