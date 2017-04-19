<?php 
	 session_start();
	require 'database.php';
	
	$id = null;

	if ( !empty($_GET['id'])) {
		$id = $_SESSION['test_taker_id'];
	}
	
	if ( null==$id ) {
		header("Location: home.php");
	}
	
	if ( !empty($_POST)) {
		if(isset($_POST['update']))
		{
			// keep track validation errors
			$first_nameError = null;
			$last_nameError = null;
			$usernameError = null;
			
			// keep track post values
			$first_name=($_POST['first_name']);
			$last_name=($_POST['last_name']);
			$username=($_POST['username']);

			
		
			$valid = true;
			if (empty($first_name)) {
				$first_nameError = 'Please enter First Name';
				$valid = false;
			}
			
			if (empty($last_name)) {
				$last_nameError = 'Please enter Last Name';
				$valid = false;
			}
			
			if (empty($username)) {
				$usernameError = 'Please enter Username';
				$valid = false;
			}
			
			// update data
			if ($valid) {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE Test_Takers  set first_name = ?, last_name = ?, username =? WHERE test_taker_id= ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($first_name,$last_name,$username,$id));

				$_SESSION['username'] = $username;
				Database::disconnect();

				header("Location: home.php");
			}
		}
		else
		{
			if($_SESSION['teacher'] == 1)
			{
				header("Location: teacher_home.php");
			}
			else
			{
				header("Location: home.php");
			}
			 
		}
	} 
	else {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM Test_Takers where test_taker_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($id));
			$result = $q->fetch(PDO::FETCH_ASSOC);
			$first_name = $result['first_name'];
			$last_name = $result['last_name'];
			$username = $result['username'];
			Database::disconnect();
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    
    				<div class="row">

						<div class="col-lg-12" style="text-align:center;">
							<h1>Update Profile</h1>
						</div>
		    		</div> 		
	    			<form class="form-horizontal"  method="post">
					<div class="row">
						<div class="col-lg-5"></div>
						<div class="col-lg-7">
						  <div class="control-group <?php echo !empty($first_nameError)?'error':'';?>">
							<label class="control-label">First Name :</label>
							<div class="controls">
								<input name="first_name" type="text"  placeholder="first name" value="<?php echo !empty($first_name)?$first_name:'';?>">
								<?php if (!empty($first_nameError)): ?>
									<span class="help-inline"><?php echo $first_nameError;?></span>
								<?php endif; ?>
							</div>
						  </div>
						  </div>
					</div>
					<div class="row">
						<div class="col-lg-5"></div>
						<div class="col-lg-7">					
					  <div class="control-group <?php echo !empty($last_nameError)?'error':'';?>">
					    <label class="control-label">Last Name :</label>
					    <div class="controls">
					      	<input name="last_name" type="text" placeholder="last name" value="<?php echo !empty($last_name)?$last_name:'';?>">
					      	<?php if (!empty($last_nameError)): ?>
					      		<span class="help-inline"><?php echo $last_nameError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					</div>
					</div>
					<div class="row">
						<div class="col-lg-5"></div>
						<div class="col-lg-7">					
					  <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
					    <label class="control-label">Username :</label>
					    <div class="controls">
					      	<input name="username" type="text"  placeholder="username" value="<?php echo !empty($username)?$username:'';?>">
					      	<?php if (!empty($usernameError)): ?>
					      		<span class="help-inline"><?php echo $usernameError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  </div>
					</div>
					<br/>

					<div class="row">

						<div class="col-lg-5"></div>
						
					  <div class="form-actions">
					  <div class="col-lg-1">	
						  <button type="submit" name="update" class="btn btn-success" style="height:30px; width:80px;">Update</button>
					  </div>
					   <div class="col-lg-6">
						  <button type="submit" name="back"class="btn btn-success" style="height:30px; width:80px;">Back</button>
						</div>
						</div>
					</div>
					</form>
			
				
    </div> <!-- /container -->
  </body>
</html>