<?php
/*
date: 2015-06-28
created by:ritesh
description: log class,to log object progress
*/
class log {
	public $map;
	public $ipadd;
	public $msg;
	public $state;
	public $dtype;
//
	public function __construct($map, $ipadd, $dtype, $msg, $state) {
		$this->map = $map;
		$this->ipadd = $ipadd;
		$this->dtype = $dtype;
		$this->msg = $msg;
		$this->state = $state;
	}
//
	public function logdb() {
		$logmap = $this->map;
		$logdevadd = $this->ipadd;
		$logmsg = $this->msg;
		$logstate = $this->state;
		$logdtype = $this->dtype;
		$logdbadd = "localhost";
		$logdbuser = "root";
		$logdbpass = "wortel";
		$logdbcur = "db_php_backup";
		//
		if ($logmysql = new mysqli($logdbadd, $logdbuser, $logdbpass, $logdbcur)) {
			echo "Connection to sql server successful. \n";
			if ($logmysql->query ("INSERT INTO tbl_progress_log (dev_map, dev_ip, dev_type, msg, state) VALUES ('$logmap', '$logdevadd', '$logdtype', '$logmsg', '$logstate')")) {
			echo "Log table has been updated.\n";
			$logmysql->close();
			} else {
			echo "Failed to update log table.\n";
			$logmysql->close();
			}
		} else {
		echo "Connection failed: " . $logmysql->connect_error."\n";
		$logmysql->close();
		}//end else for !$logmysql
	}//end of logdb method
}//end of log object
?>
