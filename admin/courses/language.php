<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");

$myfile = fopen("ML/a.txt", "w") or die("Unable to open file!");
$txt = "1";
fwrite($myfile, $txt);
fclose($myfile);


$sel = "SELECT * FROM speech_therapy";
$res = mysqli_query($con, $sel);
$questions = [];
while ($row = mysqli_fetch_assoc($res)) {
    $questions[] = $row['sentence'];
}
?>

    <script>
let questions = <?php echo json_encode($questions); ?>;
let currentIndex = 0; // Start from the first question

function loadQuestion() {
    // Clear feedback message when loading a new question
    document.getElementById("feedbackMessage").innerHTML = "";
	
	if (currentIndex >= questions.length) {
        document.getElementById("feedbackMessage").innerText = "You've completed all the questions!";
        document.getElementById("jumbledWords").innerHTML = "";
        document.getElementById("dropArea").innerHTML = "";
        return;
    }

    const sentence = questions[currentIndex];
    const words = sentence.split(" ");
    const extraWords = ["quickly", "ran", "dog", "jumped"]; // Distractors
    const allWords = words.concat(extraWords);
    shuffle(allWords);

    // Clear previous words
    const jumbledWordsDiv = document.getElementById("jumbledWords");
    jumbledWordsDiv.innerHTML = "";

    // Display shuffled words
    allWords.forEach((word, index) => {
        const wordDiv = document.createElement("div");
        wordDiv.className = "draggable-word";
        wordDiv.draggable = true;
        wordDiv.id = `word-${index}`;
        wordDiv.innerText = word;
        wordDiv.style = "display:inline-block; margin: 5px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; cursor: move;";
        
        wordDiv.addEventListener("dragstart", (e) => {
            e.dataTransfer.setData("text", e.target.id);
        });

        jumbledWordsDiv.appendChild(wordDiv);
    });

    // Prepare the drop area
    const dropArea = document.getElementById("dropArea");
    dropArea.innerHTML = "<p>Drop words here in the correct order:</p>";
    dropArea.addEventListener("dragover", (e) => e.preventDefault());
    dropArea.addEventListener("drop", (e) => {
        e.preventDefault();
        const wordId = e.dataTransfer.getData("text");
        const wordElement = document.getElementById(wordId);
        
        // Ensure words are placed in the drop area without nested elements
        if (wordElement) {
            dropArea.appendChild(wordElement);
        }
    });
}

// Shuffle words function
function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

// ✅ Fixed Check Sentence Function
function checkSentence() {
    const dropArea = document.getElementById("dropArea");
    const arrangedWords = Array.from(dropArea.querySelectorAll(".draggable-word")).map((child) => child.innerText.trim());
    const correctSentence = questions[currentIndex].split(" ");

    if (JSON.stringify(arrangedWords) === JSON.stringify(correctSentence)) {
        // Play sound
        let correctSound = new Audio("correct.mp3"); // Ensure correct.mp3 is in your project
        correctSound.play();

        // Show feedback message
        document.getElementById("feedbackMessage").innerHTML = "<span style='color:green;'>  Correct! Moving to the next question...</span>";

        // Save score
        saveScore(1);

        // Move to next question
        setTimeout(() => {
            currentIndex++;
            loadQuestion();
        }, 1500);
    } else {
        document.getElementById("feedbackMessage").innerHTML = "<span style='color:red;'>  Incorrect! Try again.</span>";
		saveScore(0);
    }
}

function saveScore(score) {
    fetch("language_score.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `score=${score}`
    })
    .then(response => response.text())
    .then(data => console.log("Score saved:", data))
    .catch(error => console.error("Error saving score:", error));
}

// Text-to-Speech Function
function speakQuestion(sentence) {
    const speech = new SpeechSynthesisUtterance(sentence);
    speech.lang = "en-US";
    window.speechSynthesis.speak(speech);
}

// JavaScript for low speak Input
function speakQuestion1(text) {
	const speech = new SpeechSynthesisUtterance(text);
	speech.lang = 'en-US'; // Set the language
	speech.rate = .5;       // Set the speed of speech
	speech.volume = 1;     // Set the volume level
	speech.pitch = 1;      // Set the pitch level
	window.speechSynthesis.speak(speech);
}


window.onload = loadQuestion;

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




<!-- JavaScript for Drag-and-Drop and Voice Recognition -->

<div class="container">
	<div class="page-inner">
		
		<div class="row">
			<div class="col-sm-6 col-md-12">
				<div class="card card-stats card-round">
					<div class="card-body">
						
						<div class="text-center">
							<img src="speak.gif" alt="Word Image" style="width:250px; height:200px;">
							<div class="d-flex justify-content-center align-items-center" style="margin-top: 10px;">
								<i class="fa fa-volume-up" style="cursor: pointer; font-size:30px; color:#4f6099; margin-right: 10px;" 
								   onclick="speakQuestion(questions[currentIndex])"></i>
								<span style="border-left: 2px solid #4f6099; height: 30px; margin: 0 10px;"></span>
								<i class="fa fa-volume-down" style="cursor: pointer; font-size:30px; color:#4f6099; margin-left: 10px;" 
								   onclick="speakQuestion1(questions[currentIndex])"></i>
							</div>
						</div>
						
						<!-- Jumbled Words Section -->
						<div class="mt-4">
							<h5>Arrange the words:</h5>
							<div id="jumbledWords" class="drag-container" style="display: flex; flex-wrap: wrap;"></div>
							<div id="dropArea" class="drop-container" style="border: 2px dashed #ddd; padding: 10px; margin-top: 20px;">
								<p>Drop words here in the correct order:</p>
							</div>
							<br>
							<button onclick="checkSentence()" class="btn btn-primary">Check Answer</button>
							<p id="feedbackMessage"></p>
						</div>
				
					</div>
				</div>
			</div>
        </div>
	</div>
</div>
