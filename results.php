<?php 
	require 'database.php';
	$prompt = "<h4>Make questions with one answer only.</h4>";
	if ( !empty($_POST)) {
		if(isset($_POST['create']))
		{
			$question_nameError = null;
			$question_answerError = null;

		
			$question_name = $_POST['question_name'];
			$question_answer = $_POST['question_answer'];
		
			
			$valid = true;
			if (empty($question_name)) {
				$question_nameError = 'Please enter a question';
				$valid = false;
			}
			
			if (empty($question_answer)) {
				$question_answerError = 'Please enter an answer';
				$valid = false;
			} 
			
			
			// insert data
			if ($valid) {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO Questions (question_name,question_answer) values(?, ?)";
				$q = $pdo->prepare($sql);
				$q->execute(array($question_name,$question_answer));
				Database::disconnect();
				$question_name = "";
				$question_answer = "";
				$prompt = "";
				$complete = "<h4>Question saved successfully.</h4>";
			}
			else
			{
				$prompt = "";
				$fail = "<h4>Transaction Failed!</h4>";
			}
		}
		elseif(isset($_POST['back']))
		{
			header("Location: home.php"); 
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
						<div class="col-lg-4  col-xs-3"></div>
						<div class="col-lg-8  col-xs-9">
							<h1>Create Questions For Quiz</h1>
						</div>
		    		</div> 		
	    			<form class="form-horizontal"  method="post">
					<div class="row">
						<div class="col-lg-3  col-xs-1"></div>
						<div class="col-lg-9  col-xs-11">
						  <div class="control-group <?php echo !empty($question_nameError)?'error':'';?>">
							<label class="control-label">Question :</label>
							<div class="controls">
								<input style="width:650px;" name="question_name" type="text"  placeholder="question" value="<?php echo !empty($question_name)?$question_name:'';?>">
								<?php if (!empty($question_nameError)): ?>
									<span class="help-inline"><?php echo $question_nameError;?></span>
								<?php endif; ?>
							</div>
						  </div>
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

						<div class="col-lg-4  col-xs-3"></div>
						
					  <div class="form-actions">
					  <div class="col-lg-3  col-xs-3">	
						  <button type="submit" name="create" class="btn btn-success" style="height:30px; width:150px;">Create Question</button>
					  </div>
					   <div class="col-lg-5 col-xs-6">
						  <button type="submit" name="back"class="btn btn-success" style="height:30px; width:150px;">Back</button>
						</div>
						</div>
					</div>
					<br/>
					<br/>
					<br/>
										<div class="row">
						<div class="col-lg-3  col-xs-3"> </div>
						<div class="col-lg-9  col-xs-9">	
						<h3>Results:</h3>
						</div>
						</div>
					 <div class="row">
							<div class="col-lg-3  col-xs-3"></div>
							<div class="col-lg-9  col-xs-9">
							<?php
									$pdo = Database::connect();
									$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$sql = "SELECT * FROM Questions";
									$q = $pdo->prepare($sql);
									$q->execute();
									$results = $q->fetchALL(PDO::FETCH_ASSOC); 
									foreach($results as $rows)
									{
										echo "<h4>".$rows['question_id']." ".$rows['question_name']. " ".$rows['question_answer']."</h4>";
									}
									Database::disconnect();
							?>
							</div>
						</div> 		
    
					</form>
			
				
    </div> <!-- /container -->
  </body>
</html>