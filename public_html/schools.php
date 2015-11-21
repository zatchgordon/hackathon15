<?php
	include_once "header.php";

	global $db;
	
	$stmt = $db->prepare("Select u.fname, u.lname, sa.year, m.mname, cc.ccname from User u join S_AS sa on u.uid = sa.uid join School s on sa.sid = s.sid join Degree d on sa.did = d.did join Major m on sa.mid = m.mid join CC_AS ccas on ccas.uid = u.uid join Career_Cluster cc on cc.ccid = ccas.ccid ");
	$stmt->execute();

	$stmt = $db->prepare("SELECT sname FROM School");
	$stmt->execute();

	$lastLetter = '';
	$currentLetter = '';


	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$currentLetter = ucfirst(substr($row['sname'], 0, 1));

			if ($currentLetter != $lastLetter){
				echo $currentLetter."<br>";	
			}

			echo "&nbsp;&nbsp;&nbsp;".$row['sname']."<br>";
			$lastLetter = $currentLetter;
	}


?>