<?php 
	require 'database.php';
	session_start();
	if ( !empty($_POST)) {
		if(isset($_POST['back']))
		{
			header("Location: teacher_home.php"); 
		}
		else
		{
			header ("Location: teacher_results.php?id=".$_POST['student']);
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
										$id = $_GET['id'];
										if($id != null)
										{
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sql = "SELECT first_name, last_name FROM Test_Takers WHERE test_taker_id = ?";
											$q = $pdo->prepare($sql);
											$q->execute(array($id));
											$results = $q->fetch(PDO::FETCH_ASSOC);
											echo "<h1 style='text-decoration: underline'>Quiz Results for ".$results['first_name']." ".$results['last_name']."</h1>";	
											Database::disconnect();	
										}
										else
										{
											echo "<h1 style='text-decoration: underline'>Choose a student to view quiz</h1>";	
										}	
																	
							?>
						</div>
		    		</div>
					<br/>
					<form class="form-horizontal"  method="post">
					<div class="row">
						<div class="col-lg-3  col-xs-1"></div>
						 <div class="form-actions">
						<div class="col-lg-3  col-xs-10">
							<select name="student">
							<?php
									
									$pdo = Database::connect();
									$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$sql = "SELECT test_taker_id, first_name, last_name FROM Test_Takers WHERE teacher = 0 ORDER BY first_name ASC";
									$q = $pdo->prepare($sql);
									$q->execute();
									$results = $q->fetchALL(PDO::FETCH_ASSOC); 
									foreach($results as $rows)
									{
										echo '<option value ="'.$rows['test_taker_id'].'">'.$rows['first_name'].' '.$rows['last_name'].'</option>';
									}
									Database::disconnect();
							
							?>		
							</select>
						  </div>
							<div class="col-lg-3  col-xs-1">
							<button type="submit" name="submit"class="btn btn-success" style="height:30px; width:200px;">View</button>
							</div>
							<div class="col-lg-3  col-xs-1"></div>
						  </div>
						  </div>
						  </div>
					<div class="row">
						<div class="col-lg-3  col-xs-3"></div>
						<div class="col-lg-9  col-xs-9">
						<?php
									$id = $_GET['id'];
								
									if($id != null)
									{
										
										$pdo = Database::connect();
										$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										$sql = "SELECT Questions.question_id, Questions.question_name, Questions.question_answer, Responses.response FROM Responses INNER JOIN Questions ON Questions.question_id = Responses.question_id WHERE Responses.test_taker_id = ?";
										$q = $pdo->prepare($sql);
										$q->execute(array($id));
										$results = $q->fetchALL(PDO::FETCH_ASSOC); 
								
										foreach($results as $rows)
										{
											echo "<h4>Question ".$rows['question_id'].": ".$rows['question_name']."</h4>";
											echo "<br/>";
											echo "<h4>Answer: ".$rows['question_answer']."</h4>";				
											echo "<h4> Their Answer: ".$rows['response']."</h4>";	
											echo "<hr>";	
											echo "<br/>";										
										}
										Database::disconnect();
									}
					
						?>
						</div>
		    		</div>
		
									
	    			<form class="form-horizontal"  method="post">
					<br/>
					<br/>
					<br/>
					<br/>
								
					<br/>
					<div class="row">

						<div class="col-lg-6  col-xs-3"></div>
						
					  <div class="form-actions">
					   <div class="col-lg-2 col-xs-9">
						  <button type="submit" name="back"class="btn btn-success" style="height:30px; width:200px;">Back</button>
						</div>
						</div>
						<div class="col-lg-4  col-xs-3"></div>
					</div>  
					</form>
				<br/>
				
    </div> <!-- /container -->
  </body>
</html>