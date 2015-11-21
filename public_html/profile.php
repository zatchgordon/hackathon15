<?php
	include_once "header.php";

	global $db;
	
	$id = $_GET['id'];

	$stmt = $db->prepare("SELECT DISTINCT * FROM User u JOIN CC_AS ccas ON ccas.uid = u.uid JOIN S_AS sas ON sas.uid = u.uid JOIN E_AS eas ON eas.uid = u.uid JOIN Career_Cluster cc ON cc.ccid = ccas.ccid JOIN School s ON s.sid = sas.sid JOIN Degree d ON d.did = sas.did JOIN Major m ON m.mid = sas.mid JOIN Employer e ON e.eid = eas.eid JOIN Job j ON j.jid = eas.jid WHERE u.uid = (:id) ORDER BY start DESC");
	$stmt->bindValue(":id", $id);
	$stmt->execute();
	
	$first = true;

	$cluster= '';
	$results = array();


	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		if ($first){
			$id = $row['uid'];
			$name = $row['fname'].' '. $row['lname'];
			$fname = $row['fname'];
			$school = $row['sname'];
			$degree= $row['dname'];
			$major = $row['mname'];
			$about = $row['about'];
			$cluster = $row['ccname'];
			$first = false;
		}
		else{
			if(in_array($row['ccid'], $results)){

			}else{
				$cluster = $cluster." <br> ". $row['ccname'];
				array_push($results, $row['ccid']);
			}
		}
		
	}

		?>
		<br><br>
		<div class="row">
			<div class="col-xs-6">
				<?php echo '<img src="images/'.$id.'.jpg" class="img-circle profilePics pull-right">'; ?>
			</div>
			<div class="col-xs-6">
				<div class="row">
					<div class="col-xs-12">
						<h3>
						<?php echo $name?>
						<h>
					</div>	

				</div>	
				<div class="row">
					<div class="col-xs-12">
						<p>
						<?php echo $school?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<p>
						<?php echo $degree . ' ' . $major?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<p>
						<?php echo $cluster?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<img src="images/icon-06.png" width="10%">
					</div>
				</div>
			</div>
		</div>
	
		<div class="row">
			<div class="col-xs-9 pull-right">
				<h3>ABOUT <?php echo $fname ?>:</h3>	
			</div>	

		</div>

		<div class="row">
			<div class="col-xs-12 pull-right text-center">
				<p>
					<?php echo $about?>
				</p>
			</div>	

		</div>

		<div class="row">
			<div class="col-xs-9 pull-right">
				<h3>EXPERIENCE:	</h3>
			</div>	

		</div>
		<?php
		$stmt = $db->prepare("SELECT DISTINCT * FROM User u JOIN CC_AS ccas ON ccas.uid = u.uid JOIN S_AS sas ON sas.uid = u.uid JOIN E_AS eas ON eas.uid = u.uid JOIN Career_Cluster cc ON cc.ccid = ccas.ccid JOIN School s ON s.sid = sas.sid JOIN Degree d ON d.did = sas.did JOIN Major m ON m.mid = sas.mid JOIN Employer e ON e.eid = eas.eid JOIN Job j ON j.jid = eas.jid WHERE u.uid = (:id) ORDER BY start DESC");
		$stmt->bindValue(":id", $id);
		$stmt->execute();
		$jobs = array();
		$ct = 1;
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					if(in_array($row['eid'], $jobs)){

			}else{
				
			

					if ($ct%2 != 0 ){
						echo '<div class="row"> <div class="col-xs-6">';
						?>
							<div class="row">
								<div class="col-xs-5 pull-right ">
									<h4>
										<?php echo $row['ename'];?>
									<h4>
								</div>	
							</div>
							<div class="row">
								<div class="col-xs-5 pull-right">
									<p>
										<?php echo $row['start'] . ' - ' . $row['end'];?>
									</p>
								</div>	
							</div>
							<div class="row">
								<div class="col-xs-5 pull-right">
									<p>
										<?php echo $row['jname'];?>
									</p>
								</div>	
							</div>
							<div class="row">
								<div class="col-xs-5 pull-right">
									<p>
										<?php echo $row['description'];?>
									</p>
								</div>	
							</div>
						</div>
						<?php
					}
					else{
						echo '<div class="col-xs-6 pull-right">';
						?>
						<div class="row">
								<div class="col-xs-5 ">
									<h4>
										<?php echo $row['ename'];?>
									<h4>
								</div>	
							</div>
							<div class="row">
								<div class="col-xs-5">
									<p>
										<?php echo $row['start'] . ' - ' . $row['end'];?>
									</p>
								</div>	
							</div>
							<div class="row">
								<div class="col-xs-5">
									<p>
										<?php echo $row['jname'];?>
									</p>
								</div>	
							</div>
							<div class="row">
								<div class="col-xs-5">
									<p>
										<?php echo $row['description'];?>
									</p>
								</div>	
							</div>
						</div>
					</div>
				</div>
						<?php


					}

					$ct++;
					}
					array_push($jobs, $row['eid']);
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
	
	
	