<?php
	include_once "header.php";

	global $db;
	
	$query = "%".$_GET['query']."%";

	$stmt = $db->prepare("SELECT DISTINCT u.uid, u.fname, u.lname, s.sname, m.mname, e.ename, d.dname, j.jname FROM User u JOIN CC_AS ccas ON ccas.uid = u.uid JOIN S_AS sas ON sas.uid = u.uid JOIN E_AS eas ON eas.uid = u.uid JOIN Career_Cluster cc ON cc.ccid = ccas.ccid JOIN School s ON s.sid = sas.sid JOIN Degree d ON d.did = sas.did JOIN Major m ON m.mid = sas.mid JOIN Employer e ON e.eid = eas.eid JOIN Job j ON j.jid = eas.jid WHERE u.fname LIKE (:query) OR u.lname LIKE (:query) OR  s.sname LIKE (:query) OR m.mname LIKE (:query) OR e.ename LIKE (:query) OR d.dname LIKE (:query) OR j.jname LIKE (:query)");
	$stmt->bindValue(":query", $query);
	$stmt->execute();

	$results = array();
	$ct = 1;
	echo "<br><br><br>";
	echo "<div class='row'><div class='col-xs-12 col-xs-push-2'>";
	echo "<h3> Search Results For: ". $_GET['query'] ."  </h3>";
	echo "</div></div>";
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

				if(in_array($row['uid'], $results)){

				}else{

					if($ct%2 != 0){
						?>
						<div class="row">
							<div class="col-md-6 col-md-push-1">
								<div class="row">
									<div class="col-xs-6">
										<?php echo '<a href="profile.php?id='.$row['uid'].'"> <img src="images/'.$row['uid'].'.jpg" class="img-circle profilePics pull-right highlightName"> </a>'; ?>
									</div>
									<div class="col-xs-6">
										<div class="row">				<!-- Name -->
											<div class="col-xs-12">
												<?php echo '<a href="profile.php?id='.$row['uid'].'">'. $row['lname'] . ', ' . $row['fname'] . '</a>';?>
											</div>
										</div>
										<div class="row">				<!-- School -->
											<div class="col-xs-12">
												<?php echo $row['sname'];?>
											</div>
										</div>
																				<div class="row">				<!-- Degree -->
											<div class="col-xs-12">
												<?php echo $row['dname'];?>
											</div>
										</div>
										<div class="row">				<!-- Major -->
											<div class="col-xs-12">
												<?php echo $row['mname'];?>
											</div>
										</div>

									</div>
								</div>
							</div>	
								<br class='visible-sm visible-xs'><br class='visible-sm visible-xs'>


						<?php




					}
					else{
						?>
							<div class="col-md-6 col-md-pull-1">
								<div class="row">
									<div class="col-xs-6">
										<?php echo '<a href="profile.php?id='.$row['uid'].'"> <img src="images/'.$row['uid'].'.jpg" class="img-circle profilePics pull-right"></a>'; ?>
									</div>
								<div class="col-xs-6">
										<div class="row">				<!-- Name -->
											<div class="col-xs-12">
												<?php echo '<a class="highlightName" href="profile.php?id='.$row['uid'].'">'. $row['lname'] . ', ' . $row['fname'] .'</a>';?>
											</div>
										</div>
										<div class="row">				<!-- School -->
											<div class="col-xs-12">
												<?php echo $row['sname'];?>
											</div>
										</div>
																				<div class="row">				<!-- Degree -->
											<div class="col-xs-12">
												<?php echo $row['dname'];?>
											</div>
										</div>
										<div class="row">				<!-- Major -->
											<div class="col-xs-12">
												<?php echo $row['mname'];?>
											</div>
										</div>

								</div>
							</div>
							
							</div>
						</div>
						<br><br>
						<?php

						

					}

						$ct++;
					array_push($results, $row['uid']);
				}



					
	}


?>

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



