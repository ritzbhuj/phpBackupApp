<?php
/*
date: 2015-06-28
created by: ritesh
description: procedure class; start object to call other objects with variables
*/
class procedure {
	public function totalrec() {
	$devdbip = "localhost";
	$devdbuser = "root";
	$devdbpass = "wortel";
	$devdb = "db_php_backup";
	
		if ($devmysql = new mysqli($devdbip, $devdbuser, $devdbpass, $devdb)) {
			echo "Connection to database successful.\n";
                        $cleartblsumm = $devmysql->query("TRUNCATE TABLE `tbl_summ`");
                        $cleartblprogresslog = $devmysql->query("TRUNCATE TABLE `tbl_progress_log`");
			if ($getallrec = $devmysql->query("SELECT * FROM tbl_devices_csv")) {
				echo "Database query was successful.\n";
				} else {
				echo "Failed to query database.\n";
			}
			$numrows = $getallrec->num_rows;
			echo "There are $numrows number of records in this table.\n";
			//2015-10-10
			$getallrectblpassword = $devmysql->query("SELECT * from tbl_password");
			$numrowstblpassword = $getallrectblpassword->num_rows;
			//end of 2015-10-10
			for ($pointer = 1; $pointer <= $numrows; $pointer++) {
				echo "testing pointer, current number = $pointer.\n";
				$devtype = $devmysql->query("SELECT * FROM tbl_devices_csv WHERE id = $pointer")->fetch_object()->Type;
				if ($devtype == "Ubiquity") {
					$devmap = $devmysql->query("SELECT * FROM `tbl_devices_csv` WHERE `id` = $pointer")->fetch_object()->Maps;
					$callcreatepath = new createfs($devmap);
					$createfspath = $callcreatepath->createpath();
					//if ($devmap == "BSM 10.21") {
						//2015-10-10
						//$devuser = $devmysql->query("SELECT username FROM tbl_password WHERE Type = '$devtype' AND Maps = '$devmap'")->fetch_object()->username;
						//$devpass = $devmysql->query("SELECT password FROM tbl_password WHERE Type = '$devtype' AND Maps = '$devmap'")->fetch_object()->password;
						//end of 2015-10-10
						$deviplist = $devmysql->query("SELECT * FROM tbl_devices_csv WHERE id = $pointer")->fetch_object()->Addresses;
						#$deviplistarray = $deviplist->fetch_array(MYSQLI_NUM);
						$deviplistbr = explode (", " ,$deviplist);
						$numipadds = count ($deviplistbr);
						if ($deviplist == "") {
							echo "number of ip addresses = 0\n";
							} else {
						echo "number of ip addresses = $numipadds\n";
						for ($ippointer = 0; $ippointer <$numipadds; $ippointer ++) {
							echo "$deviplistbr[$ippointer]\n";
							$devipadd = $deviplistbr[$ippointer];
							$xexplode = explode (".", $devipadd);
							$xe = $xexplode[0].$xexplode[1];
							//2015-10=10
								for ($j = 1 ;$j <= $numrowstblpassword; $j++){
									$d = $devmysql->query("SELECT `IPRange` FROM tbl_password WHERE `id` = $j")->fetch_object()->IPRange;
									$dexplode = explode (".", $d);
									$de = $dexplode[0].$dexplode[1];
									$passtype = $devmysql->query("SELECT `Type` FROM tbl_password WHERE `id` = $j")->fetch_object()->Type;
									if ( $xe == $de && $passtype == $devtype ) {
										echo "value=$devtype and $devmap and $devuser and $devpass.\n";
										$devuser = $devmysql->query("SELECT `username` FROM tbl_password WHERE `id` = $j")->fetch_object()->username;
										$devpass = $devmysql->query("SELECT `password` FROM tbl_password WHERE `id` = $j")->fetch_object()->password;
										$startbackup = new backup("$devipadd", "$devuser", "$devpass", "$devtype", "$devmap");
										$startbackup->scp();
									}
								}
							//end of 2015-10-10
						
						} //for ippointer loop
						} //if devlist is blank
					//} //if map is BSM
				} //if device is Ubiquity
				if ($devtype == "Ligowave") {
					$devmap = $devmysql->query("SELECT * FROM `tbl_devices_csv` WHERE `id` = $pointer")->fetch_object()->Maps;
					$callcreatepath = new createfs($devmap);
					$createfspath = $callcreatepath->createpath();
					//if ($devmap == "BSM 10.21") {
						//$devuser = $devmysql->query("SELECT username FROM tbl_password WHERE Type = '$devtype' AND Maps = '$devmap'")->fetch_object()->username;
						//$devpass = $devmysql->query("SELECT password FROM tbl_password WHERE Type = '$devtype' AND Maps = '$devmap'")->fetch_object()->password;
						$deviplist = $devmysql->query("SELECT * FROM tbl_devices_csv WHERE id = $pointer")->fetch_object()->Addresses;
						#$deviplistarray = $deviplist->fetch_array(MYSQLI_NUM);
						$deviplistbr = explode (", " ,$deviplist);
						$numipadds = count ($deviplistbr);
						if ($deviplist == "") {
							echo "number of ip addresses = 0\n";
							} else {
						echo "number of ip addresses = $numipadds\n";
						for ($ippointer = 0; $ippointer <$numipadds; $ippointer ++) {
							echo "$deviplistbr[$ippointer]\n";
							$devipadd = $deviplistbr[$ippointer];
							$xexplode = explode (".", $devipadd);
							$xe = $xexplode[0].$xexplode[1];
							echo "$xe\n";
							//2015-10=10
								for ($j = 1 ;$j <= $numrowstblpassword; $j ++) {
									$d = $devmysql->query("SELECT `IPRange` FROM tbl_password WHERE `id` = $j")->fetch_object()->IPRange;
									$dexplode = explode (".", $d);
									$de = $dexplode[0].$dexplode[1];
									echo "$xe\n";
									$passtype = $devmysql->query("SELECT `Type` FROM tbl_password WHERE `id` = $j")->fetch_object()->Type;
									if ( $xe == $de && $passtype == $devtype) {
										$devuser = $devmysql->query("SELECT `username` FROM tbl_password WHERE `id` = $j")->fetch_object()->username;
										$devpass = $devmysql->query("SELECT `password` FROM tbl_password WHERE `id` = $j")->fetch_object()->password;
										echo "value=$devtype and $devmap and $devuser and $devpass.\n";
										$startbackup = new backup("$devipadd", "$devuser", "$devpass", "$devtype", "$devmap");
										$startbackup->scp();
									}
								}
							//end of 2015-10-10
						
						} //for ippointer loop
						} //if devlist is blank
					//} //if map is BSM
				} //if device is Ligowave

			} //for pointer loop
			$getmap = new tblmapupdate();
			$getmap->updater();
			$logsum = new logcheck();
			$logsum->logsep();
			$devmysql->close();
			} else {
			echo "Connection failed: " . $logmysql->connect_error."\n";

			$devmysql->close();
		} //start of new mysqli instance
	}
}
?>
