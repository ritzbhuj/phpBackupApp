<?php

$devdbip = "localhost";
	$devdbuser = "root";
	$devdbpass = "wortel";
	$devdb = "db_php_backup";
	
$devmysql = new mysqli($devdbip, $devdbuser, $devdbpass, $devdb);
$getallrec = $devmysql->query("TRUNCATE TABLE `tbl_devices_csv`");
echo "Database query was successful.\n";
?>
