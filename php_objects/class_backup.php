<?php
/*
date: 2015-06-28
created by: ritesh
description: backup class scp funtion with logging
*/
class backup {
	public $ipadd;
	public $uname;
	public $passw;
	public $dtype;
	public $map;
//
	public function __construct($ipadd, $uname, $passw, $dtype, $map) {
		$this->ipadd = $ipadd;
		$this->uname = $uname;
		$this->passw = $passw;
		$this->dtype = $dtype;
		$this->map = $map;
	}
//
	public function scp() {
		$scpipadd = $this->ipadd;
		$scpuname = $this->uname;
		$scppassw = $this->passw;
		$scpdtype = $this->dtype;
		$scpmap = $this->map;
		$setdate = new timeset();
		$date = $setdate->timezonedate();
		//
		$scpping = (shell_exec("ping -c25 $scpipadd |grep packet |sed 's/ //g'|sed 's/,/    /g'|awk '{print $3}'|sed 's/%.*//g'"));
		if ($scpping < "100") {
			echo "Device is reachable.\n";
			$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Device is reachable.", "step pass");
			$startlog->logdb();
			echo "Packet loss to device = $scpping";
			$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Packet loss to device = $scpping", "result");
			$startlog->logdb();
			if ($sshcon = ssh2_connect($scpipadd, 22)) {
				echo "Connection established to device on port 22.\n";
				$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Connection established to device on port 22.", "step pass");
				$startlog->logdb();
				if(ssh2_auth_password($sshcon, $scpuname, $scppassw)) {
					echo "Authentication successful, connected to device.\n";
					$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Authentication successful, connected to device.", "step pass");
					$startlog->logdb();
					if($scpdtype == "Ubiquity") {
						if(ssh2_scp_recv($sshcon, '/tmp/system.cfg', '/home/phpbackup/'.$scpdtype.'/'.$date.'/'.$scpmap.'/'.$scpipadd.'.cfg')) {
							echo "Stream opened successfully and backup file has been retrieved.\n";
							$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Stream opened successfully, backup retrieved.", "success");
							$startlog->logdb();
							ssh2_exec($sshcon, 'exit');
							echo "Connection closed.\n";
							$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Connection closed.", "complete");
							$startlog->logdb();
							} else {
						echo "Failed to open stream, backup failed.\n";
						$startlog = new log ("$scpmap" ,"$scpipadd", "$scpdtype", "Failed to retrieve backup file.", "failed");
						$startlog->logdb();
						ssh2_exec($sshcon, 'exit');
						echo "Connection closed.\n";
						$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Connection closed.", "closed connection");
						$startlog->logdb();
						}
					}
					if($scpdtype == "Ligowave") {
						if(ssh2_scp_recv($sshcon, 'var/tmp/system.cfg', '/home/phpbackup/'.$scpdtype.'/'.$date.'/'.$scpmap.'/'.$scpipadd.'.cfg')) {
							echo "Stream opened successfully and backup file has been retrieved.\n";
							$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Stream opened successfully, backup retrieved.", "success");
							$startlog->logdb();
							ssh2_exec($sshcon, 'exit');
							echo "Connection closed.\n";
							$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Connection closed.", "complete");
							$startlog->logdb();
							} else {
						echo "Failed to open stream, backup failed.\n";
						$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Failed to retrieve backup file.", "failed");
						$startlog->logdb();
						ssh2_exec($sshcon, 'exit');
						echo "Connection closed.\n";
						$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Connection closed.", "closed connection");
						$startlog->logdb();
						}
					}

				} else {
				echo "Authentication failure when connecting to device.\n";
				$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Authentication failure when connecting to device.", "failed");
				$startlog->logdb();
				}
			} else {
			echo "Connection failed to device on port 22.\n";
			$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype" ,"Connection failed to device on port 22.", "failed");
			$startlog->logdb();
			}
		} else {
		echo "Device is unreachable.\n";
		$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Device is unreachable.", "failed");
		$startlog->logdb();
		echo "Packet loss to device = $scpping";
		$startlog = new log ("$scpmap", "$scpipadd", "$scpdtype", "Packet loss to device = $scpping", "result");
		$startlog->logdb();
		}
	}// end of scp method
}// end of backup object
?>
