<?php
/*
date:2015-07-16
by:ritesh
desc:create file structure
*/

class createfs {
	public $map;
//
	public function __construct($map) {
		$this->map = $map;
	}
//
	public function createpath() {
		$fsmap = $this->map;
		$setdate = new timeset();
		$date = $setdate->timezonedate();
		if ($path = mkdir("/home/phpbackup/Ubiquity/$date/$fsmap", 0755, true)) {
			echo "Ubiquity backup folder created.\n";
			} else {
		echo "Failed to create Ubiquity backup folder.\n";
		}
		if ($path = mkdir("/home/phpbackup/Ligowave/$date/$fsmap", 0755, true)) {
			echo "Ligowave backup folder created.\n";
			} else {
		echo "Failed to create Ligowave backup folder.\n";
		}
	}

}
?>
