<?php
session_start();
include("config.php");
 if(!isset($_SESSION['user_type']))
 {
	 header("location:user_login.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("head.php");?>

	
	</head>
	<body>


<?php
						$data='';

if(!empty($_POST["search_donor"]))
			{
				$sql="SELECT * FROM blood_donor WHERE `ADDRESS` LIKE '%{$_POST["ADDRESS"]}%'  AND BLOOD='{$_POST["BLOOD"]}'";
				$result=$con->query($sql);
				if($result->num_rows>0)
				{
						$i=0;
				
					while($row=$result->fetch_assoc())
					{
						{
							$i++;
							$data.="<tr>
							<td>$i</td>
						
							<td>{$row["NAME"]}</td>
							<td>{$row["GENDER"]}</td>
							<td>{$row["BLOOD"]}</td>
							<td>{$row["EMAIL"]}</td>
							
							</tr>";
						}
						
					}
					
				}
					else					{
						
					$data= "<tr><td colspan='4' class='alert alert-danger'><i class='fa fa-users'></i> No data found</td></tr>";
					}
				
			
				}

?>




















<?php include("top_nav.php"); ?>
<div class="container" style='margin:70px'>
	<div class="row">
	
		<div class="col-sm-9" >
			<h3 class="text-primary"><i class="fa fa-search"></i> Search Donor Details </h3><hr> 
			<form action="user_blood_donor.php" method="POST">
		<div class="row">
		
		<div class="col-md-4 col-md-offset-2">
	
		<div class="form-group text-primary">
			<label>Select Blood</label>
			<select name="BLOOD" id="BLOOD" required  class="form-control input-sm">
							<option value="">--Select Blood--</option>
							<option value="A+" <?php if(isset($_POST["BLOOD"])&& $_POST["BLOOD"]=='A+'){echo 'selected';} ?> >A+</option>
							<option value="B+" <?php if(isset($_POST["BLOOD"])&& $_POST["BLOOD"]=='B+'){echo 'selected';} ?> >B+</option>
							<option value="O+" <?php if(isset($_POST["BLOOD"])&& $_POST["BLOOD"]=='O+'){ echo'selected';} ?> >O+</option>
							<option value="AB+" <?php if(isset($_POST["BLOOD"])&& $_POST["BLOOD"]=='AB+'){ echo'selected';} ?> >AB+</option>
							<option value="A-" <?php if(isset($_POST["BLOOD"])&& $_POST["BLOOD"]=='A-'){ echo'selected';} ?> >A-</option>
							<option value="B-">B-</option>
							<option value="O-" <?php if(isset($_POST["BLOOD"])&& $_POST["BLOOD"]=='O-'){ echo'selected';} ?> >O-</option>
							<option value="AB-" <?php if(isset($_POST["BLOOD"])&& $_POST["BLOOD"]=='AB-'){ echo'selected';} ?> >AB-</option>
							

								</select>
		</div>
</div>



<div class="col-md-4 ">
	
				<div class="form-group text-primary">
					<label>Address</label>
					<input type="text" name="ADDRESS" class="form-control" required value="<?php if(isset($_POST["ADDRESS"])){echo $_POST["ADDRESS"]; } ?>">
				</div>
		</div>

		<div class="col-md-2 ">
	
	<div class="form-group text-primary">
		<br>

		<input type="submit" name="search_donor" class="form-control  btn btn-danger">
	</div>
</div>
		</div>
</form>
		<div class='col-md-8 col-md-offset-4'>
			<div class='table-responsive' id="feedback">
<table class="table table-striped">
			<thead>
            <tr>
				<th>S.No.</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Blood</th>
                <th>Email</th>

				</tr>
            </thead>

			<tbody>
				<?php echo $data ?>
			</tbody>
            
			</table>
			<div>
		</div>
		
		
	</div>
		
		
		</div>
	</div>
</div>
</div>
</div>

  
  
	 <?php include("footer.php"); ?>
 

	</body>
</html>