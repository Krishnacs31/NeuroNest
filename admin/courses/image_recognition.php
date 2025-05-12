<?php
//session_start();
include("table.php");
include("../common/menu.php");
include("../connection.php");

// Reset session count when starting
if (!isset($_SESSION['completed_images'])) {
    $_SESSION['completed_images'] = 0;
}

// Fetch the first random image
$sel = "SELECT * FROM image_recognition ORDER BY RAND() LIMIT 1";
$res = mysqli_query($con, $sel);
$row = mysqli_fetch_assoc($res);

// Define total images required to complete
$totalImages = 5;
?>

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-sm-6 col-md-12">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="text-center">
                            <h1 style='color:green'>Guess the Image</h1>
                            <p>Look at the image and say the name aloud to guess!</p>

                            <img src="../image_recognition/uploads/<?php echo $row['image']; ?>" 
                                 alt="Word Image" 
                                 style="width:300px; height:300px; border-radius:10px;" 
                                 id="imageToGuess"
                                 data-answer="<?php echo strtolower($row['word']); ?>">
                        </div>

                        <div class="mt-4">
                            <center><button class="btn btn-success" id="startGuessing">Start Guessing</button></center>
                            <p id="feedbackMessage"></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  const startButton = document.getElementById('startGuessing');
  const imageElement = document.getElementById('imageToGuess');
  const feedbackMessage = document.getElementById('feedbackMessage');
  let currentImageIndex = <?php echo $_SESSION['completed_images']; ?>;
  let totalImages = <?php echo $totalImages; ?>;

  // Initialize Speech Recognition
  const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
  recognition.lang = 'en-US';
  recognition.interimResults = false;

  function loadNextImage() {
    currentImageIndex++;

    if (currentImageIndex >= totalImages) {
        window.location.href = "courses.php"; // Redirect if all images are completed
        return;
    }

    fetch('fetch_next_image.php')
        .then(response => response.json())
        .then(data => {
            if (data.redirect) {
                window.location.href = "courses.php"; // Redirect once all images are done
                return;
            }
            imageElement.src = data.image;
            imageElement.setAttribute("data-answer", data.word);
            feedbackMessage.textContent = "Look at the image and guess the name!";
            feedbackMessage.style.color = "black";
        })
        .catch(error => console.error("Error fetching next image:", error));
  }

  startButton.addEventListener('click', () => {
    startButton.disabled = true;
    feedbackMessage.textContent = "Listening... Say the name of the image.";
    recognition.start();
  });

  function saveScore(score) {
    fetch("image_score.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `score=${score}`
    })
    .then(response => response.text())
    .then(data => console.log("Score saved:", data))
    .catch(error => console.error("Error saving score:", error));
  }

  recognition.addEventListener("result", (event) => {
    const spokenWord = event.results[0][0].transcript.toLowerCase();
    const correctAnswer = imageElement.getAttribute("data-answer").toLowerCase();

    if (spokenWord.includes(correctAnswer)) {
        feedbackMessage.style.color = "green";
        feedbackMessage.textContent = `Correct! You said "${spokenWord}".`;

        let audio = new Audio("correct.mp3");
        audio.play();
        saveScore(1);

        audio.onended = () => {
            alert(`Correct! You said "${spokenWord}".`);
            loadNextImage();
        };
    } else {
        feedbackMessage.style.color = "red";
        feedbackMessage.textContent = `Incorrect! You said "${spokenWord}". Try again.`;

        let audio = new Audio("wrong.mp3");
        audio.play();
        saveScore(0);

        audio.onended = () => {
            alert(`Incorrect! You said "${spokenWord}". Try again.`);
            loadNextImage();
        };
    }
  });

  recognition.addEventListener('end', () => {
    startButton.disabled = false;
  });

  function checkEmotions() {
    fetch("check_emotions.php")
    .then(response => response.json())
    .then(data => {
        if (data.redirect) {
            alert("It looks like you are not enjoying this activity. Let's try something else!");
            window.location.href = "new_activity.php"; // Redirect to a new activity
        }
    })
    .catch(error => console.error("Error checking emotions:", error));
}

// Check emotions every 5 seconds
setInterval(checkEmotions, 5000);

</script>
