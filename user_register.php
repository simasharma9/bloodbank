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
                <h1 class="page-header text-primary"><i class='fa fa-user-md'></i> User Signup
                  
                </h1>
              
            </div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
				<?php
				if(isset($_POST["register"]))
					{
						$username=$_POST["username"];
						$name=$_POST["name"];
						$pass=$_POST["pass"];
						$confirmpass=$_POST["confirmpass"];
                        if ($pass!=$confirmpass) {
							// header("location:user_register.php");
                            echo "<div class='alert alert-danger'><b>Error</b> Password Not Match</div>";
                        }else{
                            $sql="INSERT INTO `user` (`name`,`username`,`password`) VALUES ('" . $_POST["name"] . "','" . $_POST["username"] . "','" . $_POST["pass"]."')";
                            $result=$con->query($sql);
							header("location:user_login.php");

                        }
                       
					 
							
						
					}
				?>
					<form role="form" action="user_register.php" method="post">
			    	  	<div class="form-group">
							 <label for="user_name" class="text-primary">Name</label>
			    		    <input class="form-control" name="name"  id="user" type="text" required>
			    		</div>
                        <div class="form-group">
							 <label for="user_name" class="text-primary">User Name</label>
			    		    <input class="form-control" name="username"  id="user" type="text" required>
			    		</div>
			    		<div class="form-group">
							<label for="pass" class="text-primary">Password</label>
			    			<input class="form-control" id="pass" name="pass" type="password" value="" required>
			    		</div>
							
						<div class="form-group">
							<label for="pass" class="text-primary">Confirm Password</label>
			    			<input class="form-control" id="" name="confirmpass" type="password" value="" required>
			    		</div>
						
			    		<button class="btn btn-primary pull-right" name="register" type="submit"><i class="fa fa-sign-in"></i> Sign Up Here</button>
			      	</form>
<br>
<br>
<br>

					 <div style="font-size: 21px;">
						 Already have an Acount ? <a href="user_login.php">Sign In</a>
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
