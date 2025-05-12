<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");


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
						  <div class="col-icon">
							<div class="icon-big text-center icon-primary bubble-shadow-small">
							  <h1><?php echo $row['letter']; ?></h1> <!-- Display Letter -->
							  
							</div>
						  </div>
						  <div class="col col-stats ms-3 ms-sm-0">
							<div class="numbers">
							  <center><h3 class="card-category"><b><?php echo $row['word']; ?></b></h3></center> <!-- Display Word -->
							  <img src="../language/uploads/<?php echo $row['image']; ?>" alt="aaa" style="width:100px; height:100px;"> <br>
							  <form method="post">
								<input type="hidden" name="texttospeech" value="<?php echo $row['word']; ?>">
								<button type="submit" name="process" class="btn btn-danger btn-block">Read</button>
							  </form>
							  <form method="post" name="checkForm" action="">
								<input type="hidden" name="texttospeech1" value="<?php echo $row['word']; ?>">
								<input type="hidden" name="content" id="content-<?php echo $i; ?>" placeholder="Type msg" required>
								<br>
								<input type="submit" name="submit" value="Check">
							  </form>
							  <p id="demo-<?php echo $i; ?>"></p>
							  <br>
							  <!-- Button for voice input -->
							  <button onclick="startRecording(<?php echo $i; ?>)"><i class="fa fa-microphone"></i></button>
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

<script>
    function startRecording(index) {
        var recognition = new webkitSpeechRecognition();
        recognition.lang = 'en-US';
        recognition.onresult = function(event) {
            var result = event.results[0][0].transcript;
            document.getElementById('content-' + index).value = result;
        };
        recognition.start();
    }
</script>

<?php

if (isset($_POST['submit'])) {
    $input_word = strtolower($_POST['content']); 
    $expected_word = strtolower($_POST['texttospeech1']); 
	
	
	echo "cccccc".$input_word."---".$expected_word;

    
    if ($input_word == $expected_word) {
       echo "<script>alert('Correct!'); window.location='language.php'</script>";
    } else {
        echo "<script>alert('Try again!'); window.location='language.php'</script>";
    }
}
	
	include("../footer_inner.php");
	?>