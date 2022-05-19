<!DOCTYPE html>
<?php
session_start();
include("config.php");
?>
<html lang="en">

<head>

	<?php include("head.php");?>
<style>

.card {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
  gap: 1rem;
  color: rgb(152, 162, 179);
  font-size: 14px;
  background: rgb(252, 252, 253);
  box-shadow: rgb(16 24 40 / 30%) 0px 0.5px 2px;
  border-radius: 8px;
  max-width: 350px;
  margin: auto;
}

.card-header {
  display: flex;
  flex-direction: column;
}

.card-body {
  display: flex;
  flex-direction: column;
  gap: 0.8rem;
}

.card-footer {
  display: flex;
  justify-content: space-between;
  -webkit-box-align: center;
  align-items: center;
  padding: 0.2rem;
}

.card-footer .assigned {
  display: flex;
  gap: 0.2rem;
}

.card-tags {
  display: flex;
  width: 100%;
  gap: 0.2rem;
}

.card-tags label {
  padding: 6px 12px;
  background: rgb(242, 244, 247);
  color: rgb(71, 84, 103);
  font-weight: bold;
  font-size: 14px;
  line-height: 16px;
  border-radius: 6px;
  text-align: center;
  margin-right: 8px;
}

.card-header h2 {
  color: rgb(102, 112, 133);
  font-weight: bold;
  line-height: 18px;
  font-size: 15px;
}

.card-info {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  -webkit-box-align: center;
  align-items: center;
  gap: 0.5rem;
}


				.bg-danger{
					background-color: red;
					color: white;

				}
				.text-center{
					text-align: center;
					display: block;
				}
			</style>
</head>

<body>


<?php include("top_nav.php"); 
 if(!isset($_SESSION['user_type']))
 {
	 header("location:user_login.php");
 }
 
 $sql="SELECT * FROM campaign";
$result=$con->query($sql);
$rows=$result->num_rows;
$page_rows=5;

$last=ceil($rows/$page_rows);

if($last<1)
{
	$last=1;
}
$pagenum=1;
if(isset($_GET['pn']))
{
	$pagenum=preg_replace('#[^0-9]#','',$_GET['pn']);
}

if($pagenum<1){
	$pagenum=1;
}
elseif($pagenum>$last)
{
	$pagenum=$last;
}
$limit='LIMIT '.($pagenum-1)*$page_rows.','.$page_rows;

$sql="SELECT * FROM campaign  $limit ";

 $textline1="Total Campaign : $rows";
 $textline2="Page  <b>$pagenum</b> Of <b>$last</b>";
 
 $paginationctrls='<ul class="pagination">';
 if($last!=1)
 {
		 if($pagenum>1)
		 {
			 $previous=$pagenum-1;
			 $paginationctrls.=' <li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a></li>';
			 for($i=$pagenum-4;$i<$pagenum;$i++)
			 {
				 if($i>0)
				 {
					 $paginationctrls.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li>';
				 }
			 }
		 }
	 

	 $paginationctrls.='<li class="active" 	><a href="#"  >'.$pagenum.'</a></li> ';
	 
	 for($i=$pagenum+1;$i<=$last;$i++)
	 {
		 $paginationctrls.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> </li>';
		 if($i>=$pagenum+4)
		 {
			 break;
		 }
	 }
	 
	 if($pagenum!=$last)
	 {
		 $next=$pagenum+1;
		 $paginationctrls.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a></li></ul>';
	 }
	 
 }
 
 
 
// search logic 
if(isset($_POST["search"]))
					{
$from=$_REQUEST['from'];
$to=$_REQUEST['to'];

$sql="SELECT * FROM `campaign` WHERE `campaign_date` BETwEEN '$from' AND '$to'";
$result=$con->query($sql);
						}
?>






<br>
<br>
<br>


<div class="container">
<h3><i class="fa fa-clock-o"></i> View Campaign Details </h3><hr>    


	<div class="row">
	

		<div class="col-sm-12 " >
		
				<div class="col-md-4">

				<p><?php echo $textline1; ?></p>
				<p><?php echo $textline2; ?></p>
				<?php echo $paginationctrls; ?>

				
				</div>
				<div class="col-md-8">
				<form action="user_campaign.php" method="POST">
	<div class="col-md-5">
		<label class="text-center">From</label>
		<input type="date" name="from" id="" class="form-control" required></div>
	<div class="col-md-5">
	<label class="text-center">To</label>

		<input type="date" name="to" id="" class="form-control" required></div>
	<div class="col-md-2">
		<label style="margin-bottom: 20px;"></label>
		

		<input type="submit" name="search" value="search" class="form-control bg-danger"></div>

	</form>
				</div>
			</div>
		
		<div class="col-12">
			<?php 
		$list='';
 $result=$con->query($sql);
						if($result->num_rows>0)
						{
								$list="<div class='row'>";
										$i=0;
										while($row=$result->fetch_assoc())
										{
											$i++;?>
	                                           <div class="col-md-4">
												   										
											<div class="card">
  <div class="card-header">
    <h2><?php echo  $row["title"] ?></h2>
    <div class="card-info">
		<span class="date">
		<?php 
	$date=date_create($row["campaign_date"]);
	echo date_format($date,"Y M d");
 ?></span>

<span class="date">
		<?php 
	$time=date_create($row["campaign_time"]);
	echo date_format($time,"H i s A");
 ?></span>


</div>
<strong class="dot"></span><span class="author">Organised By: <?php echo  $row["organised_by"] ?></strong>

<strong class="dot"></span><span class="author">Venue: <?php echo  $row["venue"] ?></strong>
  </div>
  
  <div class="card-footer">
    <div class="comments"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 576 512" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
        <path d="M416 192c0-88.4-93.1-160-208-160S0 103.6 0 192c0 34.3 14.1 65.9 38 92-13.4 30.2-35.5 54.2-35.8 54.5-2.2 2.3-2.8 5.7-1.5 8.7S4.8 352 8 352c36.6 0 66.9-12.3 88.7-25 32.2 15.7 70.3 25 111.3 25 114.9 0 208-71.6 208-160zm122 220c23.9-26 38-57.7 38-92 0-66.9-53.5-124.2-129.3-148.1.9 6.6 1.3 13.3 1.3 20.1 0 105.9-107.7 192-240 192-10.8 0-21.3-.8-31.7-1.9C207.8 439.6 281.8 480 368 480c41 0 79.1-9.2 111.3-25 21.8 12.7 52.1 25 88.7 25 3.2 0 6.1-1.9 7.3-4.8 1.3-2.9.7-6.3-1.5-8.7-.3-.3-22.4-24.2-35.8-54.5z"></path>
      </svg></div>
    <div class="assigned"><img src="https://doodleipsum.com/32x32/avatar?bg=lightgray&amp;n=1" alt="placeholder"><img src="https://doodleipsum.com/32x32/avatar?bg=lightgray&amp;n=2" alt="placeholder"></div>
  </div>
</div>
											   </div>

										<?php }
								$list="</div>";

								
						}else {
							$list=  "<br><br><br><div class=' font-weight-800 mt-5 pt-5 text-center'><strong class=' font-weight-800 mt-5 pt-5 text-center'>No data found</strong></div>";
						}

 
?>

		</div>
		</div>
	</div>
  
  
<?php include"footer.php";?>

  
	</body>
</html>