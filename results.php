<?php 
	require 'database.php';
	session_start();
	if ( !empty($_POST)) {
		if(isset($_POST['back']))
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
						<div class="col-lg-5  col-xs-3"></div>
						<div class="col-lg-7  col-xs-9">
							<h1 style="text-decoration: underline">Quiz Results</h1>
						</div>
		    		</div> 		
	    			<form class="form-horizontal"  method="post">
					<br/>
					<br/>
					<br/>
					<div class="row">
						<div class="col-lg-3  col-xs-1"></div>
						<div class="col-lg-6  col-xs-10">
						  	<?php
									$test_taker_id = $_SESSION['test_taker_id'];

									$pdo = Database::connect();
									$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$sql = "SELECT Questions.question_id, Questions.question_name, Questions.question_answer, Responses.response FROM Responses INNER JOIN Questions ON Questions.question_id = Responses.question_id WHERE Responses.test_taker_id = ?";
									$q = $pdo->prepare($sql);
									$q->execute(array($test_taker_id));
									$results = $q->fetchALL(PDO::FETCH_ASSOC); 
														
									foreach($results as $rows)
									{
										echo "<h4>Question ".$rows['question_id'].": ".$rows['question_name']."</h4>";
										echo "<br/>";
										echo "<h4>Answer: ".$rows['question_answer']."</h4>";				
										echo "<h4> Your Answer: ".$rows['response']."</h4>";	
										echo "<hr>";	
										echo "<br/>";										
									}
									Database::disconnect();
									
							?>
						  </div>
						  <div class="col-lg-3  col-xs-1"></div>
						  </div>
								
					<br/>
					<div class="row">

						<div class="col-lg-5  col-xs-3"></div>
						
					  <div class="form-actions">
					   <div class="col-lg-2 col-xs-9">
						  <button type="submit" name="back"class="btn btn-success" style="height:30px; width:200px;">Back</button>
						</div>
						</div>
					</div>  
					</form>
				<br/>
				
    </div> <!-- /container -->
  </body>
</html>