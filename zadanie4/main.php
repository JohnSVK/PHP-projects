<?php
session_start();
if(!isset($_SESSION['google_data']) && !isset($_SESSION['login'])):header("Location: index.php");endif;

if($_SESSION['google_data']) {
		$login = $_SESSION['google_data']['given_name'];
	} else {
		$login = $_SESSION['login'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Zoznam úloh</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
	
</head>
<body>

<div class="container-fluid">
<div class="row">
	
	<div class="col-md-3">
	
	</div>
	
	<div class="col-md-5">
		<div class="row">
			<div class="col-md-10">
				<h1 class="white_text">Zoznam úloh</h1>
			</div>
			<div class="col-md-2">
				<?php
					echo "<input type=\"hidden\" id=\"add_task_owner\" value=\"{$login}\" />";
					echo "<br><br><div id=\"logged\">Prihlásený: {$login} </div>";
					echo '<br><a href="logout.php?logout">Odhlásiť sa</a>';
				?>
			</div>
		</div>
		<!-- PRIDAVANIE ÚLOHY -->
		<h3>Pridanie novej úlohy</h3>
		
		<div id="add_task">

			<div class="col-md-12">
				<div class="white_text float_left">Úroveň priority novej úlohy:</div>
				<select name="priority" id="add_task_priority">
					<option value="1">nízka priorita</option>
					<option value="2">stredná priorita</option>
					<option value="3">vysoká priorita</option>
				</select>
				
				<div class="">
					<textarea id="add_task_text" rows="4" cols="110" placeholder="Zadaj úlohu"></textarea> 
				</div>
				<button type="button" id="add_task_button" class="btn btn-default" onClick="addTask()" aria-label="Left Align">Pridaj novú úlohu</button>
				
			</div>
					
		</div>
		
		<!-- ZOZNAM ÚLOH -->
		<h3>Zoznam všetkých úloh</h3>
		
		<div id="zoznam">
		
			<!-- ÚLOHA -->
			<div class="row zoznam_task">	
				
				<!--<div class="panel panel-default">-->
				<div class="panel-body">
					<!-- Obsah -->
						<div class="col-md-12">
						
							<div class="panel panel-default">
								
								<div class="panel-heading">
									<div class="row">
									
										<div class="col-md-5">
											<div class="task_owner">
											
											</div>
										</div>
										
										<div class="col-md-2">
											<div class="task_priority">
												
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="task_date">
												
											</div>
										</div>
										
										<div class="col-md-2 task_btn">
											<!--<button onChange="finishTask(this)">Dokončiť</button>-->
										</div>
									</div>
								</div>
								<div class="panel-body">

									<p class="task_text">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium tellus lacus, eu elementum nisl pulvinar a. Praesent id risus ac neque porta bibendum. Donec ligula mauris, luctus eu blandit sed, tincidunt posuere ipsum. 
									</p>
					
								</div>
								
							</div>
						</div>		
				</div>
				<!--</div>-->
			</div>
		</div>
			
		<h3>Zoznam dokončených úloh</h3>
			
		<div id="zoznam_finished">
		
			<div class="row zoznam_task_finished">	
				
				<!--<div class="panel panel-default">-->
				<div class="panel-body">
					<!-- Obsah -->
						<div class="col-md-12">
						
							<div class="panel panel-default">
								
								<div class="panel-heading">
									<div class="row">
									
										<div class="col-md-3">
											Zadal: 
											<div class="task_owner">
											
											</div>
										</div>
										
										<div class="col-md-3">
											Dokončil: 
											<div class="task_finished_by">
											
											</div>
										</div>
										
										<div class="col-md-3">
											Dátum zadania:
											<div class="task_date">
												
											</div>
										</div>
										
										<div class="col-md-3">
											Dátum dokončenia:
											<div class="task_finished_at">
												
											</div>
										</div>
										
									</div>
								</div>
								<div class="panel-body">

									<p class="task_text">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium tellus lacus, eu elementum nisl pulvinar a. Praesent id risus ac neque porta bibendum. Donec ligula mauris, luctus eu blandit sed, tincidunt posuere ipsum. 
									</p>
					
								</div>
								
							</div>
						</div>		
				</div>
				<!--</div>-->
			</div>
		</div>
		
	</div>

	<div class="col-md-1">
		
	</div>
	
	<div class="col-md-1">
		<div class="panel panel-default userpanel">						
			<div class="panel-heading">
				Prihlásení používatelia
			</div>
			
			<div class="users panel-body">
				
			</div>
		</div>
	</div>
	
	<div class="col-md-2">
		
	</div>
	
</div>
</div>
	
    <!-- jQuery -->
    <script src="js/jquery-2.1.3.js"></script>
	<!-- jQuery cookies plugin -->
    <script src="js/jquery.cookie.js"></script>
    <!-- bootstrap-->
    <script src="js/bootstrap.min.js"></script>
	<!-- javascript -->
	<script src="js/task_manager.js"></script>
	
</body>
</html>