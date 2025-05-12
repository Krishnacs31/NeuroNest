<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");

$myfile = fopen("ML/a.txt", "w") or die("Unable to open file!");
$txt = "1";
fwrite($myfile, $txt);
fclose($myfile);

    
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
							<h2>What should you do in this situation?</h2>
							<img id="scenario-img" src="" alt="Social Scenario" style="width:200px; height:200px;">
							<p id="scenario-text"></p>

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
        const scenarios = [
		{
			image: "helping-elderly.png",
			text: "You see an elderly person struggling to carry groceries.",
			options: [
				"Offer to help carry the groceries", 
				"Ignore and walk away", 
				"Laugh and make fun", 
				"Take some groceries for yourself"
			],
			correctIndex: 0,
			feedback: [
				"Great job! Helping is the right thing to do! ",
				" That's not kind. Try again.",
				" We should never make fun of others. Try again.",
				" Taking someone's groceries is wrong. Try again."
			],
			explanationImage: "correct-helping.png",
			explanationText: "It's important to be kind and help those in need."
		},
		{
			image: "friend-falls.png",
			text: "Your friend falls down while playing.",
			options: [
				"Help them get up", 
				"Ignore and walk away", 
				"Laugh at them", 
				"Run away"
			],
			correctIndex: 0,
			feedback: [
				" Well done! Helping a friend is the right action. ",
				" Ignoring a friend is not nice. Try again.",
				" Laughing at someone who is hurt is not kind. Try again.",
				" Running away is not a good response. Try again."
			],
			explanationImage: "correct-helping-friend.png",
			explanationText: "When someone is hurt, we should help them and ask if they're okay."
		},
		{
			image: "lost-child.png",
			text: "You see a lost child crying in a park.",
			options: [
				"Find an adult or police officer to help", 
				"Ignore them", 
				"Tell them to stop crying", 
				"Take them home with you"
			],
			correctIndex: 0,
			feedback: [
				"Correct! It's best to seek help from a responsible adult or authority. ️",
				"Ignoring them is not safe. Try again.",
				"Telling them to stop crying doesn’t help. Try again.",
				"Taking them home is not the right way to help. Try again."
			],
			explanationImage: "correct-lost-child.png",
			explanationText: "A lost child needs help from a responsible adult or authority."
		},
		{
			image: "classroom-cheating.png",
			text: "Your friend asks you for answers during a test.",
			options: [
				"Refuse and encourage them to study next time", 
				"Give them all the answers", 
				"Ignore them", 
				"Tell the teacher"
			],
			correctIndex: 0,
			feedback: [
				"Correct! Encouraging honesty and hard work is the right choice. ",
				"Cheating is not fair. Try again.",
				"Ignoring them might encourage bad behavior. Try again.",
				"Instead of reporting immediately, it's better to guide them first. Try again."
			],
			explanationImage: "correct-no-cheating.png",
			explanationText: "Honesty and studying hard are the best ways to succeed."
		},
		{
			image: "sharing-food.png",
			text: "You notice a classmate who forgot their lunch.",
			options: [
				"Share some of your lunch with them", 
				"Laugh at them", 
				"Eat in front of them without sharing", 
				"Ignore them"
			],
			correctIndex: 0,
			feedback: [
				"Great choice! Sharing is a kind and thoughtful action. ",
				"Laughing at someone in need is unkind. Try again.",
				"Not sharing when you have extra is not thoughtful. Try again.",
				"Ignoring them won’t help. Try again."
			],
			explanationImage: "correct-sharing.png",
			explanationText: "Sharing with others builds kindness and friendships."
		}
	];


        let currentScenario = 0;

        function loadScenario() {
            let scenario = scenarios[currentScenario];
            document.getElementById("scenario-img").src = scenario.image;
            document.getElementById("scenario-text").innerText = scenario.text;

            let optionsContainer = document.getElementById("options-container");
            optionsContainer.innerHTML = ""; // Clear previous buttons

            scenario.options.forEach((option, index) => {
                let button = document.createElement("button");
                button.innerText = option;
                button.className = "btn btn-lg btn-outline-primary";
                button.onclick = () => checkAnswer(index);
                optionsContainer.appendChild(button);
            });

            document.getElementById("feedback").innerHTML = ""; // Clear old feedback
        }

        let currentScenarioIndex = 0; // Track the current scenario index
let totalScenarios = Object.keys(scenarios).length; // Total number of scenarios

function checkAnswer(selectedIndex) {
    let scenario = scenarios[currentScenario];
    let feedback = document.getElementById("feedback");

    if (selectedIndex === scenario.correctIndex) {
        feedback.innerHTML = scenario.feedback[selectedIndex];
        feedback.style.color = "green";

        let audio = new Audio("correct.mp3");
        audio.play();

        saveScore(1); // Save the score for a correct answer

        setTimeout(() => {
            currentScenarioIndex++; // Move to the next scenario
            if (currentScenarioIndex < totalScenarios) {
                nextScenario();
            } else {
                window.location.href = "courses.php"; // Redirect once all scenarios are completed
            }
        }, 5000); // Wait 5 seconds before moving to the next scenario
    } else {
        feedback.innerHTML = scenario.feedback[selectedIndex] + 
            "<br><br><img src='" + scenario.explanationImage + "' width='200px'><br><p>" + scenario.explanationText + "</p>";
        feedback.style.color = "red";

        let audio = new Audio("wrong.mp3");
        audio.play();
    }
}

		
		// Function to save score
		function saveScore(score) {
			fetch("situation_score.php", {
				method: "POST",
				headers: { "Content-Type": "application/x-www-form-urlencoded" },
				body: `score=${score}`
			})
			.then(response => response.text())
			.then(data => console.log("Score saved:", data))
			.catch(error => console.error("Error saving score:", error));
		}

        function nextScenario() {
            currentScenario = (currentScenario + 1) % scenarios.length;
            loadScenario();
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