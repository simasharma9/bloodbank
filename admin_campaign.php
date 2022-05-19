<?php
session_start();
include("config.php");
include("admin_function.php");
if (!isset($_SESSION['usertype'])) {
	header("location:admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("admin_head.php"); ?>
</head>

<body>

	<?php include("admin_topnav.php"); ?>
	<div class="container" style='margin-top:70px'>
		<div class="row">
			<div class="col-sm-3">
				<?php include("admin_side_nav.php"); ?>
			</div>
			<div class="col-sm-9">
				<h3 class='text-primary'><i class="fa fa-bank"></i> Add Campaign </h3>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<?php
						if (isset($_POST["campaign_submit"])) {
							
							$sql = "INSERT INTO `campaign` (`title`,`venue`,`organised_by`,`campaign_date`,`campaign_time`) VALUES ('" . $_POST["title"] . "','" . $_POST["venue"] . "','" . $_POST["organised_by"] . "','" . $_POST["campaign_date"] . "','". $_POST["campaign_time"] . "')";
							$con->query($sql);
						}

						?>

						<p id='out' class='text-success'></p>
						<form role="form" action="admin_campaign.php" method="post">
							<div class="form-group text-primary">
								<label for="title">Campaign Title</label>
								<input id="title" required type="text" class="form-control" name="title">
							</div>
								<div class="form-group text-primary">
									<label for="venue">Venue</label>
									<input id="venue" required type="text" class="form-control" name="venue">
								</div>


								<div class="form-group text-primary">
									<label for="organised">Organised By</label>
									<input id="organised" required type="text" class="form-control" name="organised_by">
								</div>
								<div class="form-group">



									<div class="form-group text-primary">
										<label for="date">Date</label>
										<input id="date" required type="date" class="form-control" name="campaign_date">
									</div>

									<div class="form-group text-primary">
										<label for="time">Time</label>
										<input id="time" required type="time" class="form-control" name="campaign_time">
									</div>
									<input type="submit" class="btn btn-primary" name='campaign_submit' value="Add Campaign">
								</div>


						</form>
					</div>
					<div class="col-md-6">
						<?php
						$sql = "SELECT * FROM `campaign` ORDER BY `id` desc LIMIT 0,5 ";
						$result = $con->query($sql);
						if ($result->num_rows > 0) {
							echo "<table class='table table-striped' >";
							echo "<tr>
											<th>#</th>
											<th>Title</th>
											<th>Venue</th>

											<th>Organiser</th>
											<th>Date</th>

											<th>Delete</th>
										</tr>";
							$i = 0;
							while ($row = $result->fetch_assoc()) {
								$i++;
								echo "<tr>";
								echo "<td>$i</td>";
								echo "<td>" . $row["title"] . "</td>";
								echo "<td>" . $row["venue"] . "</td>";
								echo "<td>" . $row["organised_by"] . "</td>";
								echo "<td>" . $row["campaign_date"] . "</td>";
								echo "<td><a href='admin_del_campaign.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></td>";
								echo "</tr>";
							}
							echo "</table>";
						} else {
							echo "<br><br><br><div class='text-danger font-weight-800 mt-5 pt-5 text-center'><strong class='text-danger font-weight-800 mt-5 pt-5 text-center'>No data</strong></div>";
						}

					
					if ($result->num_rows > 0) { ?>
<div class="text-center">
<a href='admin_view_campaign.php' class='btn btn-primary '><i class='fa fa-edit'></i> View All</a>

</div>
<?php } ?>
					</div>
				</div>


			</div>
		</div>
	</div>


	<?php include("admin_footer.php"); ?>

</body>

</html>