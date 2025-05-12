<?php
include("../common/menu.php");
include("table.php");
include("../connection.php");
?>
        <div class="container">
          <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                
				
				<form  method="post" enctype="multipart/form-data" name="update_booking_form" id="update_booking_form">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Trainer Booking</div>
						</div>
						<div class="card-body">
							<div class="row">
								<!-- Parent ID (Hidden) -->
								<input type="hidden" name="parent_id" value="<?php echo $_SESSION['uid']; ?>">

								<!-- Trainer Selection -->
								<input type="hidden" name="trainer_id" value="<?php echo $_REQUEST['id']; ?>">

								<!-- Child Selection -->
								<div class="col-md-6 col-lg-4">
									<div class="form-group">
										<label>Child</label>
										<select name="child_id" class="form-control">
											<?php
											$children = mysqli_query($con, "SELECT * FROM child WHERE parent_id='$_SESSION[uid]'");
											while ($child = mysqli_fetch_assoc($children)) {
												$selected = ($child['id'] == $booking['child_id']) ? "selected" : "";
												echo "<option value='{$child['id']}' $selected>{$child['name']}</option>";
											}
											?>
										</select>
									</div>
								</div>


								<!-- Session Date -->
								<div class="col-md-6 col-lg-4">
									<div class="form-group">
										<label>Session Date</label>
										<input type="date" name="session_date" class="form-control" value="<?php echo date('Y-m-d') ?>" required>
									</div>
								</div>

								<!-- Remarks -->
								<div class="col-md-6 col-lg-4">
									<div class="form-group">
										<label>Remarks</label>
										<textarea name="remarks" class="form-control"></textarea>
									</div>
								</div>

								<!-- Status -->
								<input type="hidden" name="amount" value="<?php echo $_REQUEST['amt']; ?>">

								<!-- Status -->
								<input type="hidden" name="status" value="pending">

								<!-- Payment Status -->
								<input type="hidden" name="payment_status" value="pending">
							</div>
						</div>

						<div class="card-action">
							<button class="btn btn-success" name="submit">Add Booking</button>
						</div>
					</div>
				</form>

              </div>
            </div>
          </div>
        </div>
		
<?php

if (isset($_POST['submit'])) {
	
    $trainer_id = $_POST['trainer_id'];
    $parent_id = $_POST['parent_id'];
    $child_id = $_POST['child_id'];
    $session_date = $_POST['session_date'];
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];
    $payment_status = $_POST['payment_status'];
    $amount = $_POST['amount'];

    $query = "INSERT INTO booking (parent_id, trainer_id, child_id, session_date, remarks, status, payment_status,amount) 
              VALUES ('$parent_id', '$trainer_id', '$child_id', '$session_date', '$remarks', '$status', '$payment_status',$amount)";

    if (mysqli_query($con, $query)) {
        echo "<script>alert('Booking added successfully'); window.location.href='../booking/select.php';</script>";
    } else {
        echo "Error inserting record: " . mysqli_error($con);
    }
}
?>		

<?php
	
	include("../footer_inner.php");
	?>
