<?php
/*
date: 2015-06-29
created by: ritesh
description: check csv file is up to date
*/
class csvcheck {
//class variable declaration
	public $csvpath;
//
	public function __construct($csvpath) {
		$this->csvpath = $csvpath;
	}//end of class constuct variable set
//
	public function procedure(){
		$devicescsvpath = $this->csvpath;

		if ($timezone = date_default_timezone_set('Africa/Johannesburg')) {
			echo "timezones have been set.\n";
				if ($date = date ('Y-m-d')) {
					echo "date has been set.\n";
					echo "date is $date.\n";
					if (file_exists($devicescsvpath)) {
						echo "file found.\n";
						if ($fdate = date ('Y-m-d', filemtime($devicescsvpath))) {
#						if ($fdate = date ('Y-m-d', 2014-01-01)) --> for testing
							echo "file created date is $fdate.\n";
							$currentdate = explode("-", $date);
							$filedate = explode("-", $fdate);
							$interval = $currentdate[2] - $filedate[2];
							echo "interval is $interval\n";
							if ($interval < 7) {
								echo "Devices file is up to date.\n";
								} else {
								echo "Devices file is not up to date.\n";
							}//endif for interval check 
							} else {
							echo "file created date not found.\n";
						}//endif for file date check

						} else {
						echo "file not found.\n";
					}//endif for file exists check
 
					} else {
					echo "failed to set date.\n";
				}//endif for date check
			} else {
			echo "failed to set timezone.\n";
		}//endif for timezone check

	}//end of procedure method
}//end of csvcheck object
?>
