<?php
/*
date:2015-07-16
by:ritesh
desc:update map table
*/
class tblmapupdate {
	public function updater() {
		$mapdbip = "localhost";
		$mapdbuser = "root";
		$mapdbpass = "wortel";
		$mapdbcsv = "db_php_backup";

		if ($mapmysql = new mysqli ($mapdbip, $mapdbuser, $mapdbpass, $mapdbcsv)) {
			echo "Connection to database successful.\n";
			if ($getallrec = $mapmysql->query("SELECT * FROM tbl_devices_csv")) {
				echo "Database query was successful.\n";
				$numrows = $getallrec->num_rows;
				echo "There are $numrows number of records in tbl_devices_csv table.\n";
				for ($pointercsv = 1; $pointercsv <= $numrows; $pointercsv++) {
					$csvmap = $mapmysql->query("SELECT * FROM tbl_devices_csv WHERE `id` = $pointercsv")->fetch_object()->Maps;
						if ($getallrecmap = $mapmysql->query("SELECT * FROM tbl_map")) {
							echo "tbl_map query was successful.\n";
							$numrowsmap = $getallrecmap->num_rows;
							for ($pointermap = 0; $pointermap <= $numrowsmap; $pointermap++) {
								$mapname = $mapmysql->query("SELECT * FROM tbl_map WHERE `id` = $pointermap")->fetch_object()->name;
								if ( $mapname == $csvmap ) {
									echo "$mapname match found in tbl_map. Exiting.\n";
									break;
								}//if $mapname equals $csvmap
								if( $mapname !== $csvmap && $pointermap == $numrowsmap) {
									if ($mapmysql->query("INSERT INTO tbl_map (name) VALUES ('$csvmap')")) {
										echo "No match found for $csvmap in tbl_map. Adding $csvmap to tbl_map\n";
										} else {
										echo "No match found for $csvmap in tbl_map. Failed to add $csvmap to tbl_map\n";
									}//if $mapmysql->query update to tbl_map is successful
								}//if $mapname not equal to $csvmap and reached end of loop, update table
							}//for pointermap
							} else {
							echo "Failed to query tbl_map";
						}//if getallrecmap
					echo "$csvmap\n";
				}//for pointer loop
				} else {
				echo "Failed to query database.\n";
			} //if getallrec
			$mapmysql->close();
			} else {
			echo "Failed to query database.\n";
		} //if connect to db
	} //end of public function updater
} //end of class tblmapupdate
?>
