#!/usr/bin/php
<?php
/*
date: 2015-08-09
created by: ritesh
description: logcheck class to check logs and create csv files
*/
class logcheck {

	public function logsep() {

		$lcdbip = "localhost";
		$lcdbuser = "root";
		$lcdbpass = "wortel";
		$lcdbcsv = "db_php_backup";
		$lcdevtype1 = "Ubiquity";
		$lcdevtype2 = "Ligowave";
		if ($lcmysql = new mysqli ($lcdbip, $lcdbuser, $lcdbpass, $lcdbcsv)) {
			echo "Connection to database successful.\n";
			if ($getallrec = $lcmysql->query("SELECT * FROM tbl_map")) {
				$numrows = $getallrec->num_rows;
				echo "There are $numrows maps.\n";
				for ($pointer = 1; $pointer <= $numrows; $pointer++) {
					$mapname = $lcmysql->query("SELECT * FROM tbl_map WHERE `id` = $pointer")->fetch_object()->name;
					if ($lcdevtype1 = "Ubiquity") {
						$getsuccess = $lcmysql->query("SELECT * FROM `tbl_progress_log` WHERE `dev_type` = 'Ubiquity' && `state` = 'success' && `dev_map` = '$mapname'");
						$totsuccess = $getsuccess->num_rows;
						echo "$totsuccess success Ubiquity on $mapname.\n";
						$getfailed = $lcmysql->query("SELECT * FROM `tbl_progress_log` WHERE `dev_type` = 'Ubiquity' && `state` = 'failed' && `dev_map` = '$mapname'");
						$totfailed = $getfailed->num_rows;
						echo "$totfailed failed Ubiquity on $mapname.\n";
						if ($lcmysql->query("INSERT INTO tbl_summ (map, device, success, fail) VALUES ('$mapname', '$lcdevtype1', '$totsuccess', '$totfailed')")) {
							echo "Backup summary table has been updated.\n";
							} else {
							echo "Failed to update backup summary table.\n";
						}//if insert update into backup summary table


						} else {
						echo "Failed to retrieve records";
					}//if dev is ubiquity

					if ($lcdevtype2 = "Ligowave") {
						$getsuccess = $lcmysql->query("SELECT * FROM `tbl_progress_log` WHERE `dev_type` = 'Ligowave' && `state` = 'success' && `dev_map` = '$mapname'");
						$totsuccess = $getsuccess->num_rows;
						echo "$totsuccess success Ligowave on $mapname.\n";
						$getfailed = $lcmysql->query("SELECT * FROM `tbl_progress_log` WHERE `dev_type` = 'Ligowave' && `state` = 'failed' && `dev_map` = '$mapname'");
						$totfailed = $getfailed->num_rows;
						echo "$totfailed failed Ligowave on $mapname.\n";

						if ($lcmysql->query ("INSERT INTO tbl_summ (map, device, success, fail) VALUES ('$mapname', '$lcdevtype2', '$totsuccess', '$totfailed')")) {
							echo "Backup summary table has been updated.\n";
							} else {
							echo "Failed to update backup summary table.\n";
						}//if insert update into backup summary table

						} else {
						echo "Failed to retrieve records";
					}//if dev is Ligowave

				}// end of for pointer loop
				} else {
			echo "Failed to query db.\n";
			}//end of if $getallrec
			} else {
			echo "Failed to connect to database.\n";
		}//end of if $mapmysql
	}//end of logsep method
} //end of logcheck object
?>
