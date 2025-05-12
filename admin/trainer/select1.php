<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");


if(isset($_REQUEST['del_id']))
{
	$del_id=$_REQUEST['del_id'];
	mysqli_query($con,"delete from $table where id='$del_id'");
	//if($del_id!="")
}
?>


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
              <h2 class="fw-bold mb-3"><?php echo $titles?></h2>
            </div>
            <div class="row">
              <div class="card">
              <div class="card-body">

                <div class="row row-demo-grid">
                  
				  <?php
					$result = mysqli_query($con, "SELECT * FROM $table");

					echo "<div class='row'>"; // Start row for Bootstrap grid

					while ($row = mysqli_fetch_array($result)) {
						$id = $row['id'];
						$name = $row['name'];
						$email = $row['email'];
						$phone = $row['phone'];
						$specialization = $row['specialization'];
						$experience = $row['experience_years'];
						$photo = !empty($row['photo']) ? "uploads/".$row['photo'] : "default.jpg"; // Default image if empty
						$status = $row['status'];
						$amount = $row['amount'];

				  ?>

						<div class="col-lg-4 col-md-6 mb-4">
							<div class="card shadow-sm">
								<div class="card-body text-center">

									<!-- Trainer Photo -->
									<div class="avatar avatar-xxl mb-3">
										<img src="<?php echo $photo; ?>" alt="Trainer Image" class="avatar-img rounded-circle" width="100">
									</div>

									<!-- Trainer Details -->
									<h5 class="card-title"><?php echo $name; ?></h5>
									<p class="card-text"><strong>Email:</strong> <?php echo $email; ?></p>
									<p class="card-text"><strong>Phone:</strong> <?php echo $phone; ?></p>
									<p class="card-text"><strong>Specialization:</strong> <?php echo $specialization; ?></p>
									<p class="card-text"><strong>Experience:</strong> <?php echo $experience; ?> years</p>

									<!-- Status Badge -->
									<p class="small">
										<span class="badge <?php echo ($status == 'available') ? 'bg-success' : 'bg-danger'; ?>">
											<?php echo ucfirst($status); ?>
										</span>
									</p>

									<!-- Action Buttons -->
									<a href="book_trainer.php?id=<?php echo $id; ?>&amt=<?php echo $amount;?>" class="btn btn-primary btn-sm">
										<i class="far fa-bookmark"></i> Book
									</a>

								</div>
							</div>
						</div>

					<?php
						}
						echo "</div>"; // Close row
					?>

                </div>
              </div>
            </div>
			</div>
          </div>
        </div>




<?php
	
	include("../footer_inner.php");
	?>