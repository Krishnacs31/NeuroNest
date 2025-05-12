<?php
include("table.php");
include("../common/menu.php");
include("../connection.php");

if(isset($_REQUEST['aid']))
{
	$aid=$_REQUEST['aid'];
	mysqli_query($con,"update $table set status='accepted' where id='$aid'");
	//if($del_id!="")
}

if(isset($_REQUEST['rid']))
{
	$rid=$_REQUEST['rid'];
	mysqli_query($con,"update $table set status='rejected' where id='$rid'");
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
					  <!--
					  <a href="form.php" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Add New
                      </a> -->
					  <br>
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
						if($_SESSION['user']=='parent')
						{
						$result = mysqli_query($con,"SELECT * FROM $table where parent_id='$_SESSION[uid]'");
						}
						elseif($_SESSION['user']=='trainer')
						{
							$result = mysqli_query($con,"SELECT * FROM $table where trainer_id='$_SESSION[uid]'");
						}
						
						while($row = mysqli_fetch_array($result))
						{
							$id=$row['0'];
							echo "<tr>";
							for($k=0;$k<$i;$k++)
							{
								if($k==1)
								{
									$sql2 = "select *  from parent where id='$row[$k]' ";
									$result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
									$row2 =mysqli_fetch_array($result2);
							
									echo "<td >  $row2[name]</td>";
									
								}
								elseif($k==2)
								{
									$sql2 = "select *  from trainer where id='$row[$k]' ";
									$result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
									$row2 =mysqli_fetch_array($result2);
							
									echo "<td >  $row2[name]</td>";
									
								}
								elseif($k==3)
								{
									$sql2 = "select *  from child where id='$row[$k]' ";
									$result2 = mysqli_query($con, $sql2) or die("Error in Selecting " . mysqli_error($connection));
									$row2 =mysqli_fetch_array($result2);
							
									echo "<td >  $row2[name]</td>";
									
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
						
						if($_SESSION['user'] == 'trainer') {
							if($row['status']=='pending')
							{
							echo "
							
							<td>
								<a href='?aid=$id' class='btn btn-success'><i class='fas fa-check'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
								<a href='?rid=$id' class='btn btn-danger'><i class='fas fa-times'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
								
								
							</td>";
							}
							else{
								echo "<td></td>";
							}
						}
						
						if($_SESSION['user'] == 'parent') {
							
							if($row['status']=='accepted')
							{
							echo "
							
							<td>
								<a href='../payment/form.php?id=$id&amt=$row[amount]' class='btn btn-success'>Pay Now</a> &nbsp;&nbsp;&nbsp;&nbsp;
								
								
							</td>";
							}
							else{
								echo "<td></td>";
							}
						}
						
						
						
							echo "</tr>";
						
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