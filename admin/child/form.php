<?php
include("../common/menu.php");
include("table.php");

if($_REQUEST['a']==1)
{
	echo "<script>alert('data added!!')</script>";
}
?>
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3"></h3>
            </div>
            <div class="row">
              <div class="col-md-12">
                
				<?php
				include("../connection.php");
				
				$g=0;
				$result = mysqli_query($con,"SHOW FIELDS FROM $table");
				$i = 0;
				
				//echo "<form action='insert.php' method='post' enctype='multipart/form-data' name='register_form' id='register_form'>";
				
				echo "
				<form action='insert.php' method='post' enctype='multipart/form-data' name='register_form' id='register_form'>
					<div class='card'>
					  <div class='card-header'>
						<div class='card-title'>Form Elements</div>
					  </div>
					  <div class='card-body'>
						<div class='row'>";
				
				while ($row = mysqli_fetch_array($result))
				{
					$name=$row['Field'];
					$type=$row['Type'];
					$type = explode("(", $type);
					$type_only=$type[0];
					$i++;

					$g++;
					
					if($i==1)
					{

					//echo "<td>Male <input type='radio' name='$name'> </td>";

					}

					elseif($i==30 )
					{
					echo "


					<div class='col-md-10'>
													<div class='form-group'><label>

					".str_replace('_', ' ', $name)."</label>";


					$sql2 = "select *  from station ";
					$result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
					echo "<select name='$name' class='form-control'>";

					while($row2 =mysqli_fetch_array($result2))
					{

					echo "<option value='$row2[station]'>$row2[station]</option>";
					}
					echo "</select>";

					echo "</div>
												</div>";



					}

					elseif($i==40)
					{
					echo "


					<div class='col-md-10'>
													<div class='form-group'><label>

					".str_replace('_', ' ', $name)."</label>";


					$sql2 = "select *  from station ";
					$result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
					echo "<select name='$name' class='form-control'>";

					while($row2 =mysqli_fetch_array($result2))
					{

					echo "<option value='$row2[station]'>$row2[station]</option>";
					}
					echo "</select>";

					echo "</div>
												</div>";



					}
					
					elseif($i==4)
					{
						echo "<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
									<label>".str_replace('_', ' ', $name)."</label>";

					                echo "<select name='$name' class='form-control'>";
									echo "<option value='male'>Male</option>";
									echo "<option value='female'>Female</option>";
									echo "</select>";

								echo "</div>
									</div>";
					}
					
					elseif($i==7)
					{
						echo "<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
									<label>".str_replace('_', ' ', $name)."</label>";

					                echo "<select name='$name' class='form-control'>";
									echo "<option value=''>-- choose --</option>";
									echo "<option value='Beginner(Basic Recognition & Interaction)'>Beginner(Basic Recognition & Interaction)</option>";	
									echo "<option value='Intermediate(intermediateCognitive & Motor Skill Development)'>Intermediate(intermediateCognitive & Motor Skill Development)</option>";
									echo "<option value='Advanced(Logical Thinking & Social Skills)'>Advanced(Logical Thinking & Social Skills)</option>";
									echo "</select>";

								echo "</div>
									</div>";
					}
					
					elseif($i==8)
					{
						echo "
							<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
								  <input
									type='hidden'
									name='$name'
									value='$_SESSION[uid]'
									class='form-control'
								  />
								</div>
							</div>";
					}
					
					
					




					else
					{

						if($type_only=="varchar" || $type_only=="int" || $type_only=="int" || $type_only=="tinyint" )
						{
							echo "
							<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
								  <label>".str_replace('_', ' ', $name)."</label>
								  <input
									type='text'
									name='$name'
									class='form-control'
								  />
								</div>
							</div>";

						}


						if($type_only=="date" )
						{
							$date=date("Y-m-d");
							echo "
							<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
								  <label>".str_replace('_', ' ', $name)."</label>
								  <input
									type='date'
									class='form-control'
									name='$name'
								  />
								</div>
							</div>";

						}


						if($type_only=="tinytext" )
						{
							echo "
							<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
								  <label>".str_replace('_', ' ', $name)."</label>
								  <input
									type='file'
									name='$name'
									class='form-control-file'
								  />
								</div>
							</div>";
						}
						if($type_only=="text" )
						{
							echo "
							<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
								  <label>".str_replace('_', ' ', $name)."</label>
								  <textarea class='form-control' rows='5' name='$name'></textarea>
								</div>
							</div>";
															
															
						}

					}

				}
				?>
					  <div class="card-action">
						<button class="btn btn-success" name='submit'>Submit</button>
						<a href="select.php" class="btn btn-danger">View All</a>
					  </div>
					</div>
				</form>
              </div>
            </div>
          </div>
        </div>

<?php
	
	include("../footer_inner.php");
	?>
