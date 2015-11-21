<?php
	include_once "header.php";

	global $db;


	$stmt = $db->prepare("SELECT sname FROM School");
	$stmt->execute();

	$lastLetter = '';
	$currentLetter = '';


	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$currentLetter = ucfirst(substr($row['sname'], 0, 1));

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
							echo '<a href="search.php?query='.$row["sname"].'">';
							echo $row['sname']."<br>";
							echo '</a>';
							$lastLetter = $currentLetter;
							?>
						</p>
					</div>

				</div>
			<?php
	
	}


?>