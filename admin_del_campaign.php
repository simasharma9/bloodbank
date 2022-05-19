<?php
include("config.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="DELETE FROM campaign WHERE id=$id";
	$con->query($sql);
	echo "<script>
		alert('Campaign Deleted');
		window.open('admin_campaign.php','_self');
	</script>";
}
?>