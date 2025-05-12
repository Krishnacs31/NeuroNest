<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");

$myfile = fopen("ML/a.txt", "w") or die("Unable to open file!");
$txt = "1";
fwrite($myfile, $txt);
fclose($myfile);

?>


<?php
@$submit = $_POST['process'];
@$word = $_POST['texttospeech'];

$voice = new COM("SAPI.SpVoice");

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($submit) and !empty($word)) {
    $voice->Speak($word);
}
?>


<div class="container">
	<div class="page-inner">
		
		<div class="row">
              
			  
			  <?php
            //include("connection.php");
            $sel = "select * from language";
            $res = mysqli_query($con, $sel);
            $i = 1;
            while ($row = mysqli_fetch_array($res)) {
                ?>
                <div class="col-sm-6 col-md-3">
  <div class="card card-stats card-round">
    <div class="card-body">
      <div class="row align-items-center">
        <div class="">
          <div class="">
            <center><h1><?php echo $row['letter']; ?></h1></center>
            <center><img src="../language/uploads/<?php echo $row['image']; ?>" alt="aaa" style="width:100px; height:100px;"></center> <br>
          
			
			
			<input name="content" type="text" id="note-textarea_<?php echo $i; ?>" placeholder="Type your guess here"> <br><br>
			<button type="button" class="btn btn-danger btn-block read-btn" data-word="<?php echo $row['word']; ?>">Read</button> &nbsp;&nbsp;&nbsp;&nbsp;
			<button type="button" class="btn btn-primary btn-block check-btn" data-correct="<?php echo $row['word']; ?>" data-index="<?php echo $i; ?>">Check</button>
<p id="demo_<?php echo $i; ?>"></p>


            <!-- Button for voice input -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


            <?php
                $i++;
            }
            ?>
			  
            </div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // "Read" button functionality (text-to-speech)
        $(".read-btn").click(function() {
            var word = $(this).data('word');  // Get word from the "data-word" attribute
            var voice = new SpeechSynthesisUtterance(word);  // Create a speech utterance
            window.speechSynthesis.speak(voice);  // Speak the word
        });

        // "Check" button functionality (compare guess with correct word)
        $(".check-btn").click(function() {
            var index = $(this).data('index');  // Get the index from the button's "data-index"
            var guess = $("#note-textarea_" + index).val().toLowerCase();  // Get the guess from the input field
            var correct = $(this).data('correct').toLowerCase();  // Get the correct word from the "data-correct" attribute

            var messageElement = $("#demo_" + index);  // Get the corresponding "p" element for the message

            // Compare guess and correct answer
            if (guess === correct) {
				// Play correct sound
				let correctSound = new Audio("correct.mp3"); // Ensure correct.mp3 is in your project
				correctSound.play();

				// Show correct message
				messageElement.text("Correct")
							  .css("color", "green");

				// Save score
				saveScore(1);
			} else {
				// Play incorrect sound
				let wrongSound = new Audio("wrong.mp3"); // Ensure wrong.mp3 is in your project
				wrongSound.play();

				// Show incorrect message
				messageElement.text("Try again!!!")
							  .css("color", "red");
			}
        });
    });
	
	
	function saveScore(score) {
    fetch("write_score.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `score=${score}`
    })
    .then(response => response.text())
    .then(data => console.log("Score saved:", data))
    .catch(error => console.error("Error saving score:", error));
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

<?php

	
	include("../footer_inner.php");
	?>