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
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title"><?php ?></h4>
					  <a href="form.php" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Add New
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
					  
					  <?php
					  
						$result2 = mysqli_query($con,"SHOW FIELDS FROM $table");
						echo "<thead><tr>";
						$i=0;
						while ($row2 = mysqli_fetch_array($result2))
						{

						  $name=$row2['Field'];

						  echo "<th>".
						  str_replace('_', ' ', $name)
						  ."</th>";
						  $i++;
						}
						echo "
						<th>Action</th> 
						</tr></thead>";
						
						echo "<tbody>";
						
						$result = mysqli_query($con,"SELECT * FROM $table ");
						
						while($row = mysqli_fetch_array($result))
						{
							$id=$row['0'];
							echo "<tr>";
							for($k=0;$k<$i;$k++)
							{
								if($k==60)
								{
									$sql2 = "select *  from customer where id='$_SESSION[userid]' ";
									$result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
									$row2 =mysqli_fetch_array($result2);
							
									echo "<td >  $row2[contact_person]</td>";
									
								}
									
								elseif($k==30)
								{	
									echo "<td class='hiddentd'> $row[content] </td>";	
								}
								
								elseif($k==40)
								{
									echo "<td > <img src='uploads/$row[$k]' width='100'></td>";
								}
								
								else
								{
									echo "<td >$row[$k]</td>";
								}
							}
						
							echo "
							
							<td>
								<a href='update.php?id=$id'><i class='fa fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
								
								<a href='?del_id=$id' onclick='return rem()'><i class='fa fa-times' style='color:red'></i></a>
							</td>
						
							</tr>";
						
						}
        
					  ?>
					  
                        
                        
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
			</div>
          </div>
        </div>


<?php
	
	include("../footer_inner.php");
	?>