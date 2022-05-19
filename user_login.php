<!DOCTYPE html>
<?php
session_start();
include("config.php");
?>
<html lang="en">

<head>

	<?php include("head.php");?>

</head>

<body>

<?php include("top_nav.php"); ?>

    <!-- Navigation -->
   

    <!-- Page Content -->
    <div class="container" style="margin-top:70px;">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-primary"><i class='fa fa-user-md'></i> User Login
                  
                </h1>
              
            </div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
				<?php
				if(isset($_POST["submit"]))
					{
						$user=$_POST["user"];
						$pass=$_POST["pass"];
                       $sql="SELECT * FROM `user` WHERE `username`='$user' AND 	`password` ='$pass'";
					   $result=$con->query($sql);
					 
						if($result->num_rows>0)
						{
							 $_SESSION['user_type'] ='user';
							 $_SESSION['user_name']='user';
							
							header("location:index.php");
						}
						else
						{
							echo "<div class='alert alert-danger'><b>Error</b> User Name or Password Incorrect.</div>";
						}
					}
				?>
					<form role="form" action="user_login.php" method="post">
			    	  	<div class="form-group">
							 <label for="user_name" class="text-primary">User Name</label>
			    		    <input class="form-control" name="user"  id="user" type="text" required>
			    		</div>
			    		<div class="form-group">
							<label for="pass" class="text-primary">Password</label>
			    			<input class="form-control" id="pass" name="pass" type="password" value="" required>
			    		</div>
					
						
			    		<button class="btn btn-primary pull-right" name="submit" type="submit"><i class="fa fa-sign-in"></i> Login Here</button>
			      	</form>
<br>
<br>
<br>

					 <div style="font-size: 21px;">
						 Don't have an Account ? <a href="user_register.php">Sign up</a>
					 </div>
				</div>
				<div class="col-md-3"></div>
			</div>
        </div>
        <!-- /.row -->


       

        <!-- Footer -->
       <?php include"footer.php";?>
  
        </div>
      
  
</body>

</html>
