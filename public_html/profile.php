<?php
	include_once "header.php";

	global $db;
	
	$id = $_GET['id'];

	$stmt = $db->prepare("SELECT DISTINCT u.fname, u.lname, s.sname, m.mname, e.ename, d.dname, j.jname FROM User u JOIN CC_AS ccas ON ccas.uid = u.uid JOIN S_AS sas ON sas.uid = u.uid JOIN E_AS eas ON eas.uid = u.uid JOIN Career_Cluster cc ON cc.ccid = ccas.ccid JOIN School s ON s.sid = sas.sid JOIN Degree d ON d.did = sas.did JOIN Major m ON m.mid = sas.mid JOIN Employer e ON e.eid = eas.eid JOIN Job j ON j.jid = eas.jid WHERE u.uid = '$id'");
	$stmt->execute();


	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo $row['lname'].', '. $row['fname'];
			echo "<br>";
	}


?>