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
    #puzzle-container {
      display: grid;
      grid-template-columns: repeat(3, 100px);
      grid-gap: 5px;
      margin: 20px auto;
      width: 315px;
    }
    .piece {
      width: 100px;
      height: 100px;
      background-size: 300px 300px;
      cursor: pointer;
      border: 1px solid #ccc;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      font-weight: bold;
    }
    .dragging {
      opacity: 0.5;
    }
  </style>


<div class="container">
	<div class="page-inner">
		
		<div class="row">
			<div class="col-sm-6 col-md-12">
				<div class="card card-stats card-round">
					<div class="card-body">
                        <div class="text-center">
                            <h1>Image Puzzle</h1>
							<p>Drag and drop the pieces to arrange the image in order!</p>
                            <div id="puzzle-container"></div>
                        </div>
                        
                        <div class="mt-4">
                            <center><button class="btn btn-success" onclick="checkSolution()">Check Solution</button></center>
                            <p id="feedbackMessage"></p>
                        </div>
                
                    </div>
				</div>
			</div>
        </div>
	</div>
</div>

<script>
    const originalOrder = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    const shuffledOrder = [...originalOrder].sort(() => Math.random() - 0.5);
    const container = document.getElementById('puzzle-container');

    // Create puzzle pieces
    shuffledOrder.forEach((number) => {
      const piece = document.createElement('div');
      piece.classList.add('piece');
      piece.setAttribute('draggable', true);
      piece.dataset.number = number;
      piece.style.backgroundImage = `url('dora.jpg')`;
      piece.style.backgroundPosition = getBackgroundPosition(number);
      piece.textContent = number;
      container.appendChild(piece);

      // Add drag and drop functionality
      piece.addEventListener('dragstart', dragStart);
      piece.addEventListener('dragover', dragOver);
      piece.addEventListener('drop', drop);
    });

    let draggedElement = null;

    function dragStart(e) {
      draggedElement = e.target;
      e.target.classList.add('dragging');
    }

    function dragOver(e) {
      e.preventDefault(); // Allow drop
    }

    function drop(e) {
      e.preventDefault();
      const targetElement = e.target;
      if (targetElement.classList.contains('piece')) {
        // Swap the pieces
        const draggedOrder = draggedElement.dataset.number;
        draggedElement.dataset.number = targetElement.dataset.number;
        targetElement.dataset.number = draggedOrder;

        // Swap their text content
        const tempText = draggedElement.textContent;
        draggedElement.textContent = targetElement.textContent;
        targetElement.textContent = tempText;

        // Swap their background positions
        const tempBg = draggedElement.style.backgroundPosition;
        draggedElement.style.backgroundPosition = targetElement.style.backgroundPosition;
        targetElement.style.backgroundPosition = tempBg;
      }
      draggedElement.classList.remove('dragging');
      draggedElement = null;
    }

    function getBackgroundPosition(number) {
      const row = Math.floor((number - 1) / 3);
      const col = (number - 1) % 3;
      return `-${col * 100}px -${row * 100}px`;
    }

    function checkEmotions() {
        fetch("check_emotions.php")
        .then(response => response.json())
        .then(data => {
            if (data.redirect) {
                alert("It looks like you're feeling frustrated. Let's try something else!");
                window.location.href = "new_activity.php"; // Redirect to another activity
            }
        })
        .catch(error => console.error("Error checking emotions:", error));
    }

    // Check emotions every 5 seconds
    setInterval(checkEmotions, 5000);

    function checkSolution() {
        const currentOrder = Array.from(container.children).map((piece) => Number(piece.dataset.number));
        
        if (JSON.stringify(currentOrder) === JSON.stringify(originalOrder)) {
            let audio = new Audio("correct.mp3");
            audio.play();

            audio.onended = () => {
                alert("Congratulations! You solved the puzzle!");
                saveScore(1); // Save score for correct solution
            };
        } else {
            alert("Not quite right, try again!");
            saveScore(0);
        }
    }

    function saveScore(score) {
        fetch("puzzle_score.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `score=${score}`
        })
        .then(response => response.text())
        .then(data => console.log("Score saved:", data))
        .catch(error => console.error("Error saving score:", error));
    }

  
  </script>