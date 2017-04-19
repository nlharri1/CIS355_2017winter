<?php 
	require 'database.php';
	$prompt = "<h4>Make questions with one answer only.</h4>";
	if ( !empty($_POST)) {
		$question_idError = null;
		$question_id = $_POST['question_id'];
		
		$valid = true;
		if (empty($question_id)) {
				$question_idError = 'Please enter an id';
				$valid = false;
		} 
		
		if(isset($_POST['update']))
		{
			$question_nameError = null;
			$question_answerError = null;
			
				
			$question_name = $_POST['question_name'];
			$question_answer = $_POST['question_answer'];
			
			
			if (empty($question_name)) {
				$question_nameError = 'Please enter a question';
				$valid = false;
			}
			
			if (empty($question_answer)) {
				$question_answerError = 'Please enter an answer';
				$valid = false;
			}
			
			if (empty($question_id)) {
				$question_idError = 'Please enter an id';
				$valid = false;
			} 
			
			// insert data
			if ($valid) {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE Questions  set question_name = ?, question_answer = ? WHERE question_id= ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($question_name,$question_answer,$question_id));
				Database::disconnect();

				$complete = "<h4>Question saved successfully.</h4>";
			}
			else
			{
				$fail = "<h4>Transaction Failed!</h4>";
			}
		}
		elseif(isset($_POST['deleteQuestion']))
		{			
			if ($valid) {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "DELETE FROM Questions WHERE question_id= ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($question_id));
				Database::disconnect();
		
				$complete = "<h4>Question deleted successfully.</h4>";
			}
			else
			{
				$fail = "<h4>Transaction Failed!</h4>";
			}	
		}
		elseif(isset($_POST['deleteAll']))
		{
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "DELETE FROM Questions";
				$q = $pdo->prepare($sql);
				$q->execute();
				Database::disconnect();
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "ALTER TABLE Questions AUTO_INCREMENT = 1";
				$q = $pdo->prepare($sql);
				$q->execute();
				Database::disconnect();
	
				$complete = "<h4>Questions deleted successfully.</h4>";
		}
		elseif(isset($_POST['back']))
		{
			header("Location: teacher_home.php"); 
		}
		$question_id = "";
		$question_name = "";
		$question_answer = "";
		$prompt = "";
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
						<div class="col-lg-4 col-xs-4"> </div>
						<div class="col-lg-8 col-xs-8">	
						<h3>Questions in the Quiz</h3>
						</div>
						</div>
						<br/>
					 <div class="row">
							<div class="col-lg-4 col-xs-3"></div>
							<div class="col-lg-8 col-xs-9">
							<?php
									$pdo = Database::connect();
									$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$sql = "SELECT * FROM Questions";
									$q = $pdo->prepare($sql);
									$q->execute();
									$results = $q->fetchALL(PDO::FETCH_ASSOC); 
									if(!empty($results))
									{
										foreach($results as $rows)
										{
											echo "<h4>".$rows['question_id']." ".$rows['question_name']. " ".$rows['question_answer']."</h4>";
										}
									}
									Database::disconnect();
							?>
							</div>
						</div> 	
					<br/>						
	    			<form class="form-horizontal"  method="post">
								<div class="row">
						<div class="col-lg-2 col-xs-2"></div>
						<div class="col-lg-8 col-xs-8">
						  <div class="control-group <?php echo !empty($question_idError)?'error':'';?>">
							<label class="control-label">Question Number:</label>
							<div class="controls">
								<input style="width:100%;" name="question_id" type="text"  placeholder="question number" value="<?php echo !empty($question_id)?$question_id:'';?>">
								<?php if (!empty($question_idError)): ?>
									<span class="help-inline"><?php echo $question_idError;?></span>
								<?php endif; ?>
							</div>
						  </div>
						  </div>
						  <div class="col-lg-2 col-xs-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-xs-2"></div>
						<div class="col-lg-8 col-xs-8">
						  <div class="control-group <?php echo !empty($question_nameError)?'error':'';?>">
							<label class="control-label">Question :</label>
							<div class="controls">
								<input style="width:100%;" name="question_name" type="text"  placeholder="question" value="<?php echo !empty($question_name)?$question_name:'';?>">
								<?php if (!empty($question_nameError)): ?>
									<span class="help-inline"><?php echo $question_nameError;?></span>
								<?php endif; ?>
							</div>
						  </div>
						  </div>
						  <div class="col-lg-2 col-xs-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-xs-2"></div>
						<div class="col-lg-8 col-xs-8">					
					  <div class="control-group <?php echo !empty($question_answerError)?'error':'';?>">
					    <label class="control-label">Answer:</label>
					    <div class="controls">
					      	<input style="width:100%;" name="question_answer" type="text" placeholder="answer" value="<?php echo !empty($question_answer)?$question_answer:'';?>">
					      	<?php if (!empty($question_answerError)): ?>
					      		<span class="help-inline"><?php echo $question_answerError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					</div>
					<div class="col-lg-2 col-xs-2"></div>
					</div>
					<div class="row">
						<div class="col-lg-2 col-xs-2"> </div>
						<div class="col-lg-8 col-xs-8" style="text-align:center;">	
							<?php echo $prompt;?>
							<?php echo $complete;?>
							<?php echo $fail;?>
						</div>
						<div class="col-lg-2 col-xs-2"> </div>
					</div>
					<br/>
					<br/>
					<div class="row">
						
					  <div class="form-actions">
					  <div class="col-lg-2 col-xs-2"> </div>
					  <div class="col-lg-2 col-xs-2">	
						  <button type="submit" name="update" class="btn btn-success" style="height:30px; width:100%;">Update</button>
					  </div>
					  
						<div class="col-lg-2 col-xs-2">
							<button type="submit" name="deleteQuestion" class="btn btn-success" style="height:30px; width:100%;">Delete</button>
						</div>
						
						<div class="col-lg-2 col-xs-2">
							<button type="submit" name="deleteAll" class="btn btn-success" style="height:30px; width:100%;">Delete All</button>
						</div>
					   <div class="col-lg-2 col-xs-2">
						  <button type="submit" name="back"class="btn btn-success" style="height:30px; width:100%;">Back</button>
						</div>
						<div class="col-lg-2 col-xs-2"> </div>
						</div>
					</div>
					<br/>
					<br/>
					<br/>
		
    
					</form>
			
				
    </div> <!-- /container -->
  </body>
</html>