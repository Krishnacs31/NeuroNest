<?php
include("../common/menu.php");
include("table.php");
?>
        <div class="container">
          <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                
				<?php
				include("../connection.php");
				
				$id=$_REQUEST['id'];
				$g=0;
				$result = mysqli_query($con,"SHOW FIELDS FROM $table");
				$i = 0;
				
				//echo "<form action='insert.php' method='post' enctype='multipart/form-data' name='register_form' id='register_form'>";
				
				echo "
				<form action='update_data.php?id=$id' method='post' enctype='multipart/form-data' name='register_form' id='register_form'>
					<div class='card'>
					  <div class='card-header'>
						<div class='card-title'>Update $titles</div>
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
					
					$result2 = mysqli_query($con,"SELECT * FROM $table where id='$id'") or die(mysql_error());
					$row2= mysqli_fetch_array($result2);

					$datas=$row2[$name];
					//echo $datas;
					
					
					if($i==1)
					{

					//echo "<td>Male <input type='radio' name='$name'> </td>";

					}
					elseif($i==4)
					{

					echo "
							<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
								  <label>".str_replace('_', ' ', $name)."</label>
								  <input
									type='time'
									name='$name'
									value='$datas'
									class='form-control'
								  />
								</div>
							</div>";

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
									value='$datas'
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
									value='$datas'
								  />
								</div>
							</div>";

						}


						if($type_only=="tinytext" )
						{
							echo "
							<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
								  <label>".str_replace('_', ' ', $name)."</label>								  >
								  <input
									type='file'
									name='$name'
									class='form-control-file'
									value='$datas'
								  />
								  <img src='uploads/$datas' width='100'>
								</div>
							</div>";
						}
						if($type_only=="text" )
						{
							echo "
							<div class='col-md-6 col-lg-4'>
								<div class='form-group'>
								  <label>".str_replace('_', ' ', $name)."</label>
								  <textarea class='form-control' rows='5' name='$name' >$datas</textarea>
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
