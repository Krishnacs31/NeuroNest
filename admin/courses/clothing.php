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
   .quiz-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .options button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        #feedback {
            font-size: 18px;
            margin-top: 15px;
            font-weight: bold;
        }
		.iimg {
            width: 200px;
            margin: 10px 0;
        }
        .btn {
            width: 100%;
        }
  </style>


<div class="container">
	<div class="page-inner">
		
		<div class="row">
			<div class="col-sm-6 col-md-12">
				<div class="card card-stats card-round">
					<div class="card-body">
                        <div class="">
							<center>
							<br>
							<h2 id="question">Loading...</h2>
							<img id="weather-img" class="iimg" src="" alt="Weather Condition">
							
							<div id="options-container" class="d-flex flex-column gap-2"></div>
							
							<p id="feedback" class="mt-3 fw-bold"></p>
							</center>
						</div>
                
                    </div>
				</div>
			</div>
        </div>
	</div>
</div>

    <script>
        const clothingScenarios = [
            {
                question: "What should you wear on a rainy day?",
                image: "rainy.png", // Add an image for rain
                options: ["Raincoat", "Shorts", "Sweater", "Sandals"],
                correctIndex: 0,
                feedback: [" Yes! A raincoat keeps you dry! ", "Hmm… try again! What protects you from rain?"]
            },
            {
                question: "What should you wear on a hot sunny day?",
                image: "sunny.png", // Add an image for sun
                options: ["Jacket", "Sweater", "T-shirt", "Boots"],
                correctIndex: 2,
                feedback: ["Great choice! A T-shirt keeps you cool!", "Try again! What keeps you cool in the heat?"]
            },
            {
                question: "What should you wear on a snowy day?",
                image: "snowy.png", // Add an image for snow
                options: ["Flip-flops", "Sweater", "Shorts", "Scarf & Gloves"],
                correctIndex: 3,
                feedback: [" Well done! A scarf & gloves keep you warm! ", " Oops! You need warm clothes in the snow!"]
            }
        ];

        let currentScenarioIndex = 0;

        function loadScenario() {
            let scenario = clothingScenarios[currentScenarioIndex];
            document.getElementById("question").innerText = scenario.question;
            document.getElementById("weather-img").src = scenario.image;
            let optionsContainer = document.getElementById("options-container");

            // Clear previous options
            optionsContainer.innerHTML = "";

            scenario.options.forEach((option, index) => {
                let button = document.createElement("button");
                button.innerText = option;
                button.className = "btn btn-lg btn-outline-primary";
                button.onclick = () => checkAnswer(index);
                optionsContainer.appendChild(button);
            });

            document.getElementById("feedback").innerText = ""; // Clear old feedback
        }

        function checkAnswer(selectedIndex) {
			let scenario = clothingScenarios[currentScenarioIndex];
			let isCorrect = selectedIndex === scenario.correctIndex;

			// Play sound based on correctness
			let sound = new Audio(isCorrect ? "correct.mp3" : "wrong.mp3");
			sound.play();

			// Display feedback message
			document.getElementById("feedback").innerText = isCorrect ? scenario.feedback[0] : scenario.feedback[1];

			if (isCorrect) {
				saveScore(1); // Save score for correct answer
			}else{
				saveScore(0);
			}

			setTimeout(() => {
				currentScenarioIndex = (currentScenarioIndex + 1) % clothingScenarios.length;
				loadScenario();
			}, 2000);
		}
		
		// Function to save score
		function saveScore(score) {
			fetch("cloth_score.php", {
				method: "POST",
				headers: { "Content-Type": "application/x-www-form-urlencoded" },
				body: `score=${score}`
			})
			.then(response => response.text())
			.then(data => console.log("Score saved:", data))
			.catch(error => console.error("Error saving score:", error));
		}

        window.onload = loadScenario;

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