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
                            <h1>Music Therapy</h1>
							<p>Follow along with the music and sing the song!</p>
							
                              <!-- Lyrics Section -->
							  <div class="lyrics" id="lyrics">
								Twinkle Twinkle Little Star<br>
								How I wonder what you are! <br>
								Up above the world so high, <br>
								Like a diamond in the sky. <br>
								Twinkle, twinkle, little star, <br>
								How I wonder what you are! <br>
							  </div>

							  <!-- Audio Playback -->
							  <audio id="music" src="twinkle.mp3" controls></audio>
                        </div>
                        
                        <div class="mt-4">
                            
                        </div>
                
                    </div>
				</div>
			</div>
        </div>
	</div>
</div>


<script>
// Improved speech recognition script
let recognition;
let songLyrics = [
    "twinkle twinkle little star",
    "how i wonder what you are",
    "up above the world so high",
    "like a diamond in the sky",
    "twinkle twinkle little star",
    "how i wonder what you are"
];
let spokenLines = [];
let isRecognizing = false;

// Check if browser supports speech recognition
if (!('SpeechRecognition' in window || 'webkitSpeechRecognition' in window)) {
    console.error("Speech recognition not supported in this browser");
    document.addEventListener('DOMContentLoaded', () => {
        const lyricsDiv = document.getElementById("lyrics");
        if (lyricsDiv) {
            lyricsDiv.insertAdjacentHTML('afterend', 
                '<div class="alert alert-warning">Speech recognition is not supported in your browser. Please try Chrome, Edge, or Safari.</div>');
        }
    });
}

function startRecognition() {
    if (!recognition) {
        recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
        recognition.lang = "en-US";
        recognition.interimResults = false;
        recognition.continuous = false;
        
        recognition.onresult = (event) => {
            let spokenText = event.results[0][0].transcript.toLowerCase().trim();
            console.log("Recognized:", spokenText);
            spokenLines.push(spokenText);
            
            highlightRecognizedLyric(spokenText);
            checkCompletion();
        };
        
        recognition.onerror = (event) => {
            console.error("Speech recognition error:", event.error);
            if (event.error === "not-allowed") {
                alert("Microphone access is blocked. Please enable it in your browser settings.");
            }
        };
        
        recognition.onend = () => {
            let music = document.getElementById("music");
            if (isRecognizing && !music.paused) {
                setTimeout(() => recognition.start(), 500);
            }
        };
    }
    
    spokenLines = [];
    isRecognizing = true;
    
    try {
        recognition.start();
        console.log("Recognition started");
    } catch (error) {
        console.error("Error starting recognition:", error);
    }
}

function highlightRecognizedLyric(text) {
    const lyricsDiv = document.getElementById("lyrics");
    if (!lyricsDiv) return;

    const originalHTML = lyricsDiv.innerHTML;
    const matchingIndex = songLyrics.findIndex(line => 
        text.includes(line) || line.includes(text));
    
    if (matchingIndex >= 0) {
        const lineNumber = matchingIndex + 2;
        const lines = originalHTML.split('<br>');
        
        if (lines.length > lineNumber) {
            lines[lineNumber] = '<span style="background-color: #4CAF50; color: white;">' + lines[lineNumber] + '</span>';
        }
        
        lyricsDiv.innerHTML = lines.join('<br>');
    }
}

function checkCompletion() {
    let matchCount = 0;
    songLyrics.forEach(lyric => {
        if (spokenLines.some(spoken => spoken.includes(lyric) || lyric.includes(spoken))) {
            matchCount++;
        }
    });

    console.log("Matched " + matchCount + " of " + songLyrics.length + " lines");

    if (matchCount >= songLyrics.length) {
        alert("🎉 Congratulations! You completed the song!");
        saveScore(1);
        if (recognition) recognition.stop();
        isRecognizing = false;

        setTimeout(() => {
            window.location.href = "courses.php";
        }, 2000);
    } else {
        alert("Try again! You've not completed the song!");
        saveScore(0);
    }
}

// New Function: **Check User Emotion in Real-Time**
function checkEmotion() {
    fetch("check_emotions.php")
    .then(response => response.json())
    .then(data => {
        console.log("Emotion Data:", data);
        if (data.redirect) {
            alert("You seem frustrated. Let's try something else!");
            let music = document.getElementById("music");
            if (music) music.pause();  // Stop music if playing
            window.location.href = "new_activity.php";
        }
    })
    .catch(error => console.error("Error checking emotions:", error));
}

// Start recognition and emotion checking when the music plays
document.addEventListener('DOMContentLoaded', () => {
    const music = document.getElementById("music");
    if (music) {
        music.addEventListener("play", () => {
            console.log("Music started playing");
            startRecognition();
            setInterval(checkEmotion, 5000); // Check emotion every 5 seconds
        });

        music.addEventListener("pause", () => {
            console.log("Music paused");
            if (recognition) {
                recognition.stop();
                isRecognizing = false;
            }
        });

        music.addEventListener("ended", () => {
            console.log("Music ended");
            if (recognition) {
                recognition.stop();
                isRecognizing = false;
            }
        });
    } else {
        console.error("Music element not found");
    }
    
    // Add a manual start button as fallback
    const lyricsDiv = document.getElementById("lyrics");
    if (lyricsDiv) {
        lyricsDiv.insertAdjacentHTML('afterend', 
            '<button id="startSinging" class="btn btn-success">Start Singing</button>');
        
        document.getElementById("startSinging")?.addEventListener("click", () => {
            const music = document.getElementById("music");
            if (music.paused) {
                music.play();
            }
            startRecognition();
            setInterval(checkEmotion, 5000);
        });
    }
});

function saveScore(score) {
    fetch("music_score.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "score=" + score
    })
    .then(response => response.text())
    .then(data => console.log("Score saved:", data))
    .catch(error => console.error("Error saving score:", error));
}

</script>


