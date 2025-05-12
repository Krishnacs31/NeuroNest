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


if(isset($_REQUEST['aid']))
{
	include("../connection.php");
	$aid=$_REQUEST['aid'];
	mysqli_query($con,"update $table set status='accepted' where id='$aid'");

	$sel9="select * from trainer where id='$aid'";
	//echo $sel;
	$result9 = mysqli_query($con,$sel9);
	$row9=mysqli_fetch_array($result9);

	$subject = "Welcome to NeuroNest";
	$title = "Your Login Credentials";
	$msg = "Dear User,\n\n"
		 . "Greetings from NeuroNest! We are pleased to inform you that your registration has been accepted.\n\n"
		 . "Here are your login details:\n"
		 . "Email ID: {$row9['email']}\n"
		 . "Password: {$row9['password']}\n\n"
		 . "Please log in using these credentials and update your password for security.\n\n"
		 . "Best regards,\n"
		 . "The NeuroNest Team";

	$email=$row9['email'];
	include('mail.php');
	
	
	
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
	if(confirm('Are you sure you want to reject this record?')){
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
					  <?php
					  if($_SESSION['user']=='admin')
					  {
						  ?>
					  <a href="form.php" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Add New
                      </a>
					  <?php } ?>
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
								
								elseif($k==7)
								{
									echo "<td > <img src='uploads/$row[$k]' width='100'></td>";
								}
								elseif($k==8)
								{
									echo "<td > <a href='uploads/$row[$k]' target='_blank'>$row[$k]</a></td>";
								}
								
								else
								{
									echo "<td >$row[$k]</td>";
								}
							}
						
							echo "
							
							<td>
								<a href='?aid=$id'><i class='fa fa-check'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
								
								<a href='?rid=$id' onclick='return rem2()'><i class='fa fa-times' style='color:red'></i></a>
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