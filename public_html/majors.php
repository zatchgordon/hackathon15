<?php
	include_once "header.php";

	global $db;

	$stmt = $db->prepare("SELECT mname FROM Major");
	$stmt->execute();

	$lastLetter = '';
	$currentLetter = '';
	echo '<section class="row" style="width: 50%; margin-left: auto; margin-right: auto;">
	<div class="col-xs-12">';
	
	echo "<h3>Majors</h3>";
	
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$currentLetter = ucfirst(substr($row['mname'], 0, 1));

			if ($currentLetter != $lastLetter){

				?>
				<div class="row">
					<div class="col-xs-12">
						<h3>
							<?php
							echo $currentLetter."<br>";	
							?>
						</h3>
					</div>

				</div>
			<?php
				
			}
			?>
				<div class="row">
					<div class="col-xs-12">
						<p>

							<?php
							echo '<a href="search.php?query='.$row["mname"].'">';
							echo $row['mname']."<br>";
							echo '</a>';
							$lastLetter = $currentLetter;
							?>
						</p>
					</div>

				</div>
			<?php

	}


?>
</div>
	</section>
	
	<div class="row footer">
		<div class="col-xs-12">
			<img src="images/logo.png" class="footerLogo" alt="logo">
				<img class="pull-right" src="images/iconLinkedin.png" alt="LinkedIn logo">
				<img class="pull-right" src="images/iconTwitter.png" alt="LinkedIn logo">
				<img class="pull-right" src="images/iconFacebook.png" alt="LinkedIn logo">
				<img class="pull-right" src="images/iconInsta.png" alt="LinkedIn logo">
				<img class="pull-right" src="images/iconInsta.png" alt="LinkedIn logo">
		</div>
	</div>