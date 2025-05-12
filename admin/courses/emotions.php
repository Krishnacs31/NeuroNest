<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");

$myfile = fopen("ML/a.txt", "w") or die("Unable to open file!");
$txt = "1";
fwrite($myfile, $txt);
fclose($myfile);

// Fetch the first random image
$sel = "SELECT * FROM image_recognition ORDER BY RAND() LIMIT 1";
$res = mysqli_query($con, $sel);
$row = mysqli_fetch_assoc($res);
    
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
                            <h1>Understanding Emotions</h1>
							<p>Identify the emotion in an image (happy, sad, angry, surprised, etc.).</p>
							
                            <img id="emotion-img" src="happy.png" alt="Emotion Image" style="width:30%">
							<div class="options">
								<button onclick="checkAnswer('happy')">Happy</button>
								<button onclick="checkAnswer('sad')">Sad</button>
								<button onclick="checkAnswer('angry')">Angry</button>
								<button onclick="checkAnswer('surprised')">Surprised</button>
							</div>
							<p id="feedback"></p>
							
                        </div>
                        
                
                    </div>
				</div>
			</div>
        </div>
	</div>
</div>

    <script>
        // Emotion images and correct answers
        const emotions = [
            { image: "happy.png", answer: "happy" },
            { image: "sad.png", answer: "sad" },
            { image: "angry.png", answer: "angry" },
            { image: "surprised.png", answer: "surprised" }
        ];

        let currentEmotion = 0; // Track current emotion

        let currentEmotionIndex = 0; // Track the current emotion index
let totalEmotions = Object.keys(emotions).length; // Total number of emotions

function checkAnswer(selected) {
    let correctAnswer = emotions[currentEmotion].answer;
    let feedback = document.getElementById("feedback");

    if (selected === correctAnswer) {
        feedback.innerHTML = "Great job! This is a " + correctAnswer + " face!";
        feedback.style.color = "green";

        let audio = new Audio("correct.mp3");
        audio.play();

        saveScore(1); // Save the score for a correct answer
    } else {
        feedback.innerHTML = "Try again! This is not " + selected + ".";
        feedback.style.color = "red";

        let audio = new Audio("wrong.mp3");
        audio.play();
        
        saveScore(0);
    }

    currentEmotionIndex++; // Move to the next emotion

    setTimeout(() => {
        if (currentEmotionIndex < totalEmotions) {
            nextEmotion(); // Load the next emotion
        } else {
            window.location.href = "courses.php"; // Redirect once all emotions are completed
        }
    }, 5000);
}


		// Function to save score
		function saveScore(score) {
			fetch("emotion_score.php", {
				method: "POST",
				headers: { "Content-Type": "application/x-www-form-urlencoded" },
				body: `score=${score}`
			})
			.then(response => response.text())
			.then(data => console.log("Score saved:", data))
			.catch(error => console.error("Error saving score:", error));
		}

        function nextEmotion() {
            currentEmotion = (currentEmotion + 1) % emotions.length;
            document.getElementById("emotion-img").src = emotions[currentEmotion].image;
            document.getElementById("feedback").innerHTML = "";
        }

        function checkEmotions() {
    fetch("check_emotions.php")
    .then(response => response.json())
    .then(data => {
        if (data.redirect) {
            alert("It looks like you're not enjoying this activity. Let's try something else!");
            window.location.href = "new_activity.php"; // Or another fun activity
        }
    })
    .catch(error => console.error("Error checking emotions:", error));
}

// Check emotions every 5 seconds
setInterval(checkEmotions, 5000);

    </script>