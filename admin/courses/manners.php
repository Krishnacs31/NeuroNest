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
							<h2 id="scenario-question">Loading...</h2>
							<img id="scenario-img" src="" alt="Polite Manners" width="250px">
							
							<div class="options"  id="options-container"></div>
							
							<p id="feedback"></p>
							</center>
						</div>
                
                    </div>
				</div>
			</div>
        </div>
	</div>
</div>

    <script>
        // List of manners scenarios
        const mannersScenarios = [
            {
                question: "What do you say when someone gives you a gift?",
                image: "gift.png",
                options: ["Nothing", "Thank you!"],
                correctIndex: 1,
                feedback: [" Oops! It's polite to say 'Thank you!'.", " Great job! Saying 'Thank you!' is the right thing to do!"]
            },
            {
                question: "What do you do before entering someone's room?",
                image: "knocking-door.png",
                options: ["Just walk in", "Knock first"],
                correctIndex: 1,
                feedback: [" You should always knock before entering a room.", " That's right! Knocking before entering is respectful. "]
            },
            {
                question: "What should you say when someone helps you?",
                image: "helping-hand.png",
                options: ["Ignore them", "Thank you!"],
                correctIndex: 1,
                feedback: ["	 You should always appreciate help by saying 'Thank you!'.", " That's correct! Saying 'Thank you!' is a polite way to show appreciation. "]
            }
        ];

        let currentScenarioIndex = 0;

        // Load a scenario dynamically
        function loadScenario() {
            let scenario = mannersScenarios[currentScenarioIndex];
            document.getElementById("scenario-question").innerText = scenario.question;
            document.getElementById("scenario-img").src = scenario.image;
            document.getElementById("options-container").innerHTML = ""; // Clear old options
            
            scenario.options.forEach((option, index) => {
                let button = document.createElement("button");
                button.innerText = option;
                button.onclick = () => checkAnswer(index);
                document.getElementById("options-container").appendChild(button);
            });

            document.getElementById("feedback").innerText = ""; // Clear old feedback
        }

        // Check the answer
        function checkAnswer(selectedIndex) {
			let scenario = mannersScenarios[currentScenarioIndex];
			let feedback = document.getElementById("feedback");

			feedback.innerText = scenario.feedback[selectedIndex];

			if (selectedIndex === scenario.correctIndex) {
				feedback.style.color = "green";

				let audio = new Audio("correct.mp3"); // Play correct sound
				audio.play();

				saveScore(1); // Save score when the answer is correct

				setTimeout(() => {
					currentScenarioIndex++;
					
					// Check if all scenarios are completed
					if (currentScenarioIndex >= mannersScenarios.length) {
						// Redirect to another page when all activities are completed
						window.location.href = "courses.php";
					} else {
						// Load the next scenario
						loadScenario();
					}
				}, 5000);
			} else {
				feedback.style.color = "red";

				let audio = new Audio("wrong.mp3"); // Play incorrect sound
				audio.play();
				saveScore(0); 
			}
		}

		// Function to save score
		function saveScore(score) {
			fetch("manner_score.php", {
				method: "POST",
				headers: { "Content-Type": "application/x-www-form-urlencoded" },
				body: `score=${score}`
			})
			.then(response => response.text())
			.then(data => console.log("Score saved:", data))
			.catch(error => console.error("Error saving score:", error));
		}

        // Load the first scenario when the page loads
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