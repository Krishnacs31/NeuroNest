<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");




$sel = "select * from speech_therapy";
$res = mysqli_query($con, $sel);
$i = 1;
$row = mysqli_fetch_array($res);
$word=$row['sentence'];
?>




<div class="container">
	<div class="page-inner">
		
		<div class="row">
			<div class="col-sm-6 col-md-12">
				<div class="card card-stats card-round">
					<div class="card-body">
						
						<div class="row align-items-center justify-content-center">
							<div class="col d-flex flex-column align-items-center position-relative">
								<!-- Image centered -->
								<img src="speak.gif" alt="Word Image" style="width:250px; height:200px;">
								
								<!-- Icons centered in a single line with a separator -->
								<div class="d-flex justify-content-center align-items-center" style="margin-top: 10px;">
									<i class="fa fa-volume-up" style="cursor: pointer; font-size:30px; color:#4f6099; margin-right: 10px;" onclick="speakQuestion('<?php echo htmlspecialchars($word); ?>')"></i>
									
									<!-- Separator Line -->
									<span style="border-left: 2px solid #4f6099; height: 30px; margin: 0 10px;"></span>
									
									<i class="fa fa-volume-down" style="cursor: pointer; font-size:30px; color:#4f6099; margin-left: 10px;" onclick="speakQuestion1('<?php echo htmlspecialchars($word); ?>')"></i>
								</div>
							</div>
						</div>
						
						<!-- Display jumbled words below the image -->
						<div class="mt-4">
							<h5>Arrange the words:</h5>
							<div id="jumbledWords" class="drag-container" style="display: flex; flex-wrap: wrap;">
								<?php
								// Example sentence
								//$word = "This is a cat";  
								$words = explode(" ", $word);  // Split the sentence into words

								// Extra words to add
								$extraWords = ["dog", "quickly", "ran", "under"];  

								// Merge the original words with the extra words
								$allWords = array_merge($words, $extraWords);

								shuffle($allWords);  // Shuffle the combined words randomly

								// Display each word in a draggable div
								foreach ($allWords as $index => $word) {
									echo "<div class='draggable-word' draggable='true' id='word-$index' style='display:inline-block; margin: 5px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; cursor: move;'>$word</div>";
								}
								?>
							</div>
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

<!-- JavaScript for Drag-and-Drop and Voice Recognition -->
<script>
	
	let draggedWord = null;
	const originalWords = ["This", "is", "a", "cat"]; // Correct order of words
	let droppedWords = [];

	// Enable drag-and-drop functionality for jumbled words
	document.querySelectorAll('.draggable-word').forEach(word => {
		word.addEventListener('dragstart', function(e) {
			draggedWord = e.target;
			setTimeout(function() {
				draggedWord.style.opacity = '0.5';
			}, 0);
		});

		word.addEventListener('dragend', function() {
			draggedWord.style.opacity = '1';
			draggedWord = null;
		});
	});

	const dropArea = document.getElementById('dropArea');

	dropArea.addEventListener('dragover', function(e) {
		e.preventDefault(); // Allow dropping
	});

	dropArea.addEventListener('drop', function(e) {
		e.preventDefault();

		// Only drop if the dragged item is a word
		if (draggedWord) {
			dropArea.appendChild(draggedWord);  // Append the dragged word into the drop area
			droppedWords.push(draggedWord.innerText); // Store the word in the dropped array
		}
	});

	// Function to check if the sentence is correct
	function checkSentence() {
		// Check if the dropped words are in the correct order
		if (JSON.stringify(droppedWords) === JSON.stringify(originalWords)) {
			document.getElementById('feedbackMessage').innerHTML = "Correct! Well done!";
			playClapSound(); // Play clap sound when correct
		} else {
			document.getElementById('feedbackMessage').innerHTML = "Try again!";
			playClapSound1();
		}
	}

	// Function to play the clap sound
	function playClapSound() {
		const audio = new Audio('clap.mpeg');  // Replace with the path to your clap sound file
		audio.play();
	}
	
	// Function to play the fail sound
	function playClapSound1() {
		const audio = new Audio('fail.mpeg');  // Replace with the path to your clap sound file
		audio.play();
	}
	
	// JavaScript for speak Input
    function speakQuestion(text) {
        const speech = new SpeechSynthesisUtterance(text);
        speech.lang = 'en-US'; // Set the language
        speech.rate = 1;       // Set the speed of speech
        speech.volume = 1;     // Set the volume level
        speech.pitch = 1;      // Set the pitch level
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

</script>

