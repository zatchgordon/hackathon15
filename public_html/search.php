<?php
	include_once "header.php";

	global $db;
	
	$query = "%".$_GET['query']."%";

	$stmt = $db->prepare("SELECT DISTINCT u.uid, u.fname, u.lname, s.sname, m.mname, e.ename, d.dname, j.jname FROM User u JOIN CC_AS ccas ON ccas.uid = u.uid JOIN S_AS sas ON sas.uid = u.uid JOIN E_AS eas ON eas.uid = u.uid JOIN Career_Cluster cc ON cc.ccid = ccas.ccid JOIN School s ON s.sid = sas.sid JOIN Degree d ON d.did = sas.did JOIN Major m ON m.mid = sas.mid JOIN Employer e ON e.eid = eas.eid JOIN Job j ON j.jid = eas.jid WHERE u.fname LIKE (:query) OR u.lname LIKE (:query) OR  s.sname LIKE (:query) OR m.mname LIKE (:query) OR e.ename LIKE (:query) OR d.dname LIKE (:query) OR j.jname LIKE (:query)");
	$stmt->bindValue(":query", $query);
	$stmt->execute();

	$results = array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

				if(in_array($row['uid'], $results)){

				}else{
					echo $row['lname'].', '. $row['fname'];
					echo "<br>";
					array_push($results, $row['uid']);
				}
	}


?>