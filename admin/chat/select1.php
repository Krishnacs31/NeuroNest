<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");
error_reporting(0);

if(isset($_REQUEST['del_id']))
{
	$del_id=$_REQUEST['del_id'];
	mysqli_query($con,"delete from $table where id='$del_id'");
	//if($del_id!="")
}


date_default_timezone_set('Asia/Kolkata');
if(isset($_POST['ccc']))
{
    $date = date('Y-m-d H:i:s');
    mysqli_query($con,"INSERT INTO chat(sid,message,date_time,userid,type) VALUES('$_REQUEST[id]','$_POST[msgd]','$date','$_SESSION[uid]','parent')");
	//echo "INSERT INTO chat(sid,message,date_time,userid) VALUES('$_REQUEST[id]','$_POST[msgd]','$date','$_SESSION[uid]')";
    header("location:select.php?id=$_REQUEST[id]");
}


?>

<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}

.rh_page__main {
    width: 100%;
}


        .chat-wrapper{
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 10px;
            height: 400px;
            overflow-y: scroll;
            flex-direction: column;
            display: flex;
            flex-direction: column-reverse; /* Reverse the order of the messages */
        }

        .message-wrapper {
            margin-bottom: 10px;
        }

        .message-bubble {
            display: inline-block;
            max-width: 70%;
            padding: 10px;
            border-radius: 10px;
            color: #434242;
            font-size: 14px;
        }

        .message-bubble1 {
            display: inline-block;
            max-width: 70%;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 14px;
        }

        .sent-bubble {
            background-color: #0695FF;
            align-self: flex-end;
        }

        .received-bubble {
            background-color: #fff;
            align-self: flex-start;
        }

        .message-time {
            font-size: 12px;
            color: #777;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .message-input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 14px;
        }

        .send-button {
            background-color: #5BC0F8;
            color: #fff;
            border: none;
            padding: 8px;
            border-radius: 50%;
            margin-left: 5px;
            cursor: pointer;
        }

        .send-button i {
            font-size: 16px;
        }

        .chat-header {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 10px;
        }

        .chat-header-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-header-name {
            font-weight: bold;
        }
		
		.container {
			width: 768px;
		}
    </style>

<script>
	function rem()
	{
	if(confirm('Are you sure you want to delete this record?')){
	return true;
	}
	else
	{
	return false;
	}
	}


	function rem2()
	{
	if(confirm('Are you sure you want to deactive this record?')){
	return true;
	}
	else
	{
	return false;
	}
	}
</script>


<div class="container">
   <div class="page-inner">
      <div class="page-header">
         <h2 class="fw-bold mb-3"><?php echo $titles ?></h2>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <!-- Chat Section (8 Columns) -->
                     <div class="col-md-8 market-update-gd">
						<div class="market-update-block">
							<div class="market-update-left">
								<h4></h4>
								<div class="row justify-content-between">
									<div class="container">

										<?php if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) { ?>
											<!-- Chat Header -->
											<?php
											$sel = mysqli_query($con, "SELECT * FROM `trainer` WHERE id='$_REQUEST[id]'");
											while ($row = mysqli_fetch_array($sel)) {
											?>
											<div class="chat-header">
												<img class="chat-header-image" src="../trainer/uploads/<?php echo $row['photo']; ?>" alt="Profile Image">
												<h4><?php echo $row['name'] ?></h4>
											</div>
											<?php } ?>

											<!-- Chat Messages -->
											<div class="chat-wrapper" id="message">
												<?php
												$sel = "SELECT * FROM chat WHERE (userid='$_SESSION[uid]' and sid='$_REQUEST[id]')  OR  (userid='$_REQUEST[id]' and sid='$_SESSION[uid]')  ORDER BY id DESC";
												$result = mysqli_query($con, $sel);
												while ($row = mysqli_fetch_array($result)) {
													$currentDateTime12Hr = date("d-m-Y h:i A", strtotime($row['date_time']));
													if ($row['userid'] == $_SESSION['uid'] && $row['type'] == 'parent') {
														echo "<div class='message-wrapper sent' style='text-align:right'>";
														echo "<div class='message-bubble1 sent-bubble' style='text-align:right'>";
														echo "<span class='message-text' style='text-align:right'>$row[message]</span>";
														echo "<br>";
														echo "<span class='message-time' style='text-align:right'>$currentDateTime12Hr</span>";
														echo "</div>";
														echo "</div>";
													} else {
														echo "<div class='message-wrapper received'>";
														echo "<div class='message-bubble received-bubble'>";
														echo "<span class='message-text'>$row[message]</span>";
														echo "<br>";
														echo "<span class='message-time'>$currentDateTime12Hr</span>";
														echo "</div>";
														echo "</div>";
													}
												}
												?>
											</div>

											<!-- Message Input -->
											<form action="" method="post">
												<div class="input-wrapper">
													<input type="text" class="message-input" name="msgd" placeholder="Message" required>
													<button type="submit" class="send-button" name="ccc">
														<i class="fa fa-paper-plane"></i>
													</button>
												</div>
											</form>

										<?php } else { ?>
											<p style="text-align: center; font-size: 18px; color: #777; padding: 20px;">Please select a trainer to start chatting.</p>
										<?php } ?>

									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Trainers Section -->
					<div class="col-md-4 market-update-gd" style="background-color: #deffe3; border-radius: 8px;">
						<div class="market-update-block">
							<div class="market-update-left">
								<h4>Trainers Section</h4>
								<?php
								include("connection.php");

								$sel = "SELECT DISTINCT id, name FROM trainer";
								$result = mysqli_query($con, $sel);

								while ($row = mysqli_fetch_array($result)) {
								?>
									<p><a href="?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></p>
								<?php } ?>
							</div>
						</div>
					</div>

                  </div> <!-- End Row -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
    function reloadChat() {
        $("#message").load(location.href + " #message > *", function(response, status, xhr) {
            if (status == "error") {
                console.error("Error loading chat:", xhr.status, xhr.statusText);
            }
        });
    }

    setInterval(reloadChat, 3000); // Reload chat every 3 seconds
</script>


<?php
	
	include("../footer_inner.php");
	?>