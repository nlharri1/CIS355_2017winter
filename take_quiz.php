<?php 
	require 'database.php';
		session_start();

	
	if ( !empty($_POST)) 
	{
		if(isset($_POST['create']))
		{
			
			$question_answerError = null;
			
			$question_answer = $_POST['question_answer'];
			$test_taker_id = $_SESSION['test_taker_id'];
			$question_id = $_SESSION['questionPositon'];	
			
			$valid = true;

			
			if (empty($question_answer)) {
				$question_answerError = 'Please enter an answer';
				$valid = false;
			} 

			// insert data
			if ($valid) {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO Responses (test_taker_id,question_id,response) values(?, ?, ?)";
				$q = $pdo->prepare($sql);
				$q->execute(array($test_taker_id,$question_id,$question_answer));
				Database::disconnect();
				$question_answer = "";
				$prompt = "";
				$complete = "<h4>Answer saved successfully.</h4>";
				$_SESSION['questionPositon'] = $_SESSION['questionPositon'] + 1;
				
				if($_SESSION['questionPositon'] > $_SESSION['numOfQuestions'])
				{
					header("Location: home.php");
				}
			}
			else
			{
				$prompt = "";
				$fail = "<h4>Transaction Failed!</h4>";
			}
		}
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
						<div class="col-lg-3  col-xs-3"></div>
						<div class="col-lg-9  col-xs-9">
							<?php
									
									$question_id = $_SESSION['questionPositon'];				
									$pdo = Database::connect();
									$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$sql = "SELECT * FROM Questions WHERE question_id = ?";
									$q = $pdo->prepare($sql);
									$q->execute(array($question_id));
									$results = $q->fetch(PDO::FETCH_ASSOC); 
									Database::disconnect();
									echo "<h1>Question: ".$results['question_name']."</h1>";
							?>
							
						</div>
		    		</div> 		
	    			<form class="form-horizontal"  method="post">
					<div class="row">
						<div class="col-lg-3  col-xs-1"></div>
						<div class="col-lg-9  col-xs-11">
						  
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3  col-xs-1"></div>
						<div class="col-lg-9  col-xs-11">					
					  <div class="control-group <?php echo !empty($question_answerError)?'error':'';?>">
					    <label class="control-label">Answer:</label>
					    <div class="controls">
					      	<input style="width:650px;" name="question_answer" type="text" placeholder="answer" value="<?php echo !empty($question_answer)?$question_answer:'';?>">
					      	<?php if (!empty($question_answerError)): ?>
					      		<span class="help-inline"><?php echo $question_answerError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					</div>
					</div>
					<div class="row">
						<div class="col-lg-3  col-xs-1"> </div>
						<div class="col-lg-7  col-xs-11" style="text-align:center;">	
							<?php echo $prompt;?>
							<?php echo $complete;?>
							<?php echo $fail;?>
						</div>
						<div class="col-lg-2 "> </div>
					</div>
					<br/>
					<br/>
					<div class="row">

						<div class="col-lg-3  col-xs-3"></div>
						
					  <div class="form-actions">
					  <div class="col-lg-9  col-xs-9">	
						  <button type="submit" name="create" class="btn btn-success" style="height:30px; width:150px;">Submit Answer</button>
					  </div>
						</div>
					</div>
					<br/>
					<br/>
					<br/>
										<div class="row">
						<div class="col-lg-3  col-xs-3"> </div>
						<div class="col-lg-9  col-xs-9">	
						
						</div>
						</div>
					 <div class="row">
							<div class="col-lg-3  col-xs-3"></div>
							<div class="col-lg-9  col-xs-9">

							</div>
						</div> 		
    
					</form>
			
				
    </div> <!-- /container -->
  </body>
</html>