<?php
	include_once "header.php";

	include_once "common.php";

if(!isset($_POST["email"]) || $_POST["email"]=="" || !isset($_POST["password"]) || $_POST["password"]=="")
	{
		header("HTTP/1.1 400 Bad Request - Must specify everything  when POSTing.");
		echo "you shouldn't be here";
		die();
	}


global $db;
	$user = $db->prepare("SELECT * FROM User Where email = (:email)");
	$user->bindValue(":email", $_POST["email"]);
	$user->execute();
	if($user->rowCount() == 0){
						echo "You have the wrong username or password";
					};
	$password = $_POST['password'];
	

	while ($row = $user->fetch(PDO::FETCH_ASSOC)){

			$salt = $row['salt'];
			$hash= hash('sha256', $salt.$password);

			if ($hash===$row['hash']){
						
						$id = $row['uid'];

						$stmt = $db->prepare("SELECT DISTINCT * FROM User u JOIN CC_AS ccas ON ccas.uid = u.uid JOIN S_AS sas ON sas.uid = u.uid JOIN E_AS eas ON eas.uid = u.uid JOIN Career_Cluster cc ON cc.ccid = ccas.ccid JOIN School s ON s.sid = sas.sid JOIN Degree d ON d.did = sas.did JOIN Major m ON m.mid = sas.mid JOIN Employer e ON e.eid = eas.eid JOIN Job j ON j.jid = eas.jid WHERE u.uid = (:id) ORDER BY start DESC");
						$stmt->bindValue(":id", $id);
						$stmt->execute();

						$first = true;

						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							if ($first){
								echo $row['lname'].', '. $row['fname'];
								echo "<br>";
								echo $row['dname'].' '. $row['mname'];
								$about = $row['about'];
								echo "<br>";
							}
								
							if ($first){
								echo "ABOUT: <br>";
								echo $row['about'].'<br><br>';
								$first = false;

								echo "EXPERIENCE: <br>";
							}
								echo $row['ename'].'<br>';
								echo $row['start'] . ' - ' . $row['end'] . '<br>';
								echo $row['jname'].'<br> <br>';

						}






			}
			else{
				echo "you messed up";
			}

		}
?>



<?php
	include_once "footer.php";
?>