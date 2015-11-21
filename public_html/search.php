<?php
	include_once "header.php";

	global $db;
	
	$query = "%".$_GET['query']."%";

	$stmt = $db->prepare("SELECT DISTINCT u.uid, u.fname, u.lname, s.sname, m.mname, e.ename, d.dname, j.jname FROM User u JOIN CC_AS ccas ON ccas.uid = u.uid JOIN S_AS sas ON sas.uid = u.uid JOIN E_AS eas ON eas.uid = u.uid JOIN Career_Cluster cc ON cc.ccid = ccas.ccid JOIN School s ON s.sid = sas.sid JOIN Degree d ON d.did = sas.did JOIN Major m ON m.mid = sas.mid JOIN Employer e ON e.eid = eas.eid JOIN Job j ON j.jid = eas.jid WHERE u.fname LIKE (:query) OR u.lname LIKE (:query) OR  s.sname LIKE (:query) OR m.mname LIKE (:query) OR e.ename LIKE (:query) OR d.dname LIKE (:query) OR j.jname LIKE (:query)");
	$stmt->bindValue(":query", $query);
	$stmt->execute();

	$results = array();
	$ct = 1;
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

				if(in_array($row['uid'], $results)){

				}else{

					if($ct%2 != 0){
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-xs-6">
										<?php echo '<img src="images/'.$row['uid'].'.jpg">'; ?>
									</div>
									<div class="col-xs-6">
										<div class="row">				<!-- Name -->
											<div class="col-xs-12">
												<?php echo $row['lname'] . ', ' . $row['fname'];?>
											</div>
										</div>
										<div class="row">				<!-- School -->
											<div class="col-xs-12">
												<?php echo $row['sname'];?>
											</div>
										</div>
										<div class="row">				<!-- Major -->
											<div class="col-xs-12">
												<?php echo $row['mname'];?>
											</div>
										</div>
										<div class="row">				<!-- Degree -->
											<div class="col-xs-12">
												<?php echo $row['dname'];?>
											</div>
										</div>
									</div>
								</div>
							</div>	



						<?php




					}
					else{
						?>
							<div class="col-md-6">
								<div class="row">
									<div class="col-xs-6">
										<?php echo '<img src="images/'.$row['uid'].'.jpg">'; ?>
									</div>
								<div class="col-xs-6">
										<div class="row">				<!-- Name -->
											<div class="col-xs-12">
												<?php echo $row['lname'] . ', ' . $row['fname'];?>
											</div>
										</div>
										<div class="row">				<!-- School -->
											<div class="col-xs-12">
												<?php echo $row['sname'];?>
											</div>
										</div>
										<div class="row">				<!-- Major -->
											<div class="col-xs-12">
												<?php echo $row['mname'];?>
											</div>
										</div>
										<div class="row">				<!-- Degree -->
											<div class="col-xs-12">
												<?php echo $row['dname'];?>
											</div>
										</div>
								</div>
							</div>
							
							</div>
						</div>
						<?php



					}


					array_push($results, $row['uid']);
				}



					
	}


?>