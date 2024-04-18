<?php
/*
date: 2015-06-28
created by: ritesh
description: backup summary class
*/
class backupsum {
	public function getsumm() {
		$sumdbip = "localhost";
		$sumdbuser = "root";
		$sumdbpass = "wortel";
		$sumdbcsv = "db_php_backup";
//
		if ($summysql = new mysqli ($sumdbip, $sumdbuser, $sumdbpass, $sumdbcsv)) {
			echo "Connection to database successful.\n";
			} else {
		}//if connect to db
	}//end of public function getsum
}//end of class backupsum
?>
