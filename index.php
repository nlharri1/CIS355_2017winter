<?php
session_start();
//connect to database
 require 'database.php'; 

    if ( !empty($_POST)) { 
		if(isset($_POST['signIn']))
		{  
			$passwordError = null; 
			$usernameError = null;
			 
			$username = $_POST['username'];	
			$password = $_POST['password'];		


			$valid = true;
			if (empty($username)) { 
					$$usernameError = 'Please enter Username'; 
					$valid = false; 
				}  

				if (empty($password)) { 
					$passwordError = 'Please enter password'; 
					$valid = false; 
				}  		
			if ($valid) { 
					$pdo = Database::connect(); 
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
					$sql = "SELECT * FROM Test_Takers WHERE username = ? LIMIT 1"; 
					$q = $pdo->prepare($sql); 
					$q->execute(array($username)); 
					$results = $q->fetch(PDO::FETCH_ASSOC); 
		

					if($results['password']== md5($password)) { 
						$_SESSION['test_taker_id'] = $results['test_taker_id']; 
						$_SESSION['username'] = $results['username'];
						Database::disconnect(); 
						header("Location: home.php"); // redirect 
					} 
					else { 
						$passwordError = 'Password is not valid'; 
						Database::disconnect(); 
					} 
				}
		}
		else
		{
			header("Location: register.php");
		}
    } # end if ( !empty($_POST)) 

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			
    				<div class="row">
					<div class="col-lg-2"></div>
						
							<div class="col-lg-10">	<h1>Can You Master the Ultimate Quiz?</h1></div> 
				</div>
				<div class="row">
				<div class="col-lg-4"></div>
				<div class="col-lg-8">
	    			<form class="form-horizontal" method="post">
					  <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
					    <label class="control-label">User Name</label>
					    <div class="controls">
					      	<input name="username" type="text"  placeholder="User Name" value="<?php echo !empty($username)?$username:'';?>">
					      	<?php if (!empty($usernameError)): ?>
					      		<span class="help-inline"><?php echo $usernameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($password)?'error':'';?>">
					    <label class="control-label">Password</label>
					    <div class="controls">
					      	<input name="password" type="password" placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($passwordError)): ?>
					      		<span class="help-inline"><?php echo $passwordError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <br/>
					  </div>

				</div>
					<div class="row">
					  <div class="form-actions">
					  <div class="col-lg-4"></div>
					  <div class="col-lg-1">
					  	<button type="submit" name="signIn" class="btn btn-success">Sign In</button>
						 </div>
		  <div class="col-lg-7">
						<button type ="submit" name="regester" class="btn btn-success">Register</button>
					 </div>
					 </div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
 