<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

$myhost = "localhost";
$mydbname = "hackathon15";
$myuser = "root";
$mypass = "pass";
try
{
    $db = new PDO("mysql:host=$myhost;dbname=$mydbname", "$myuser", "$mypass");
    //Makes PDO throw exceptions for invalid SQL
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $ex)
{
	header("HTTP/1.1 500 MySQL Initialization Failed");
	if($mypass == "" || $myuser == "" || $mydbname == "" || $myhost == "")
 	{
		echo 'Did you forget to configure mysql variables $mypass, $myuser, $mydbname, or $myhost? ';
	}
	die($ex->getMessage());
}
?>
