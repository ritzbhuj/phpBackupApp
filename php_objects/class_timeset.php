<?php
/*
date: 2015-06-28
created by: ritesh
description: timeset class to set time on objects where necessary
*/
class timeset {
	public function timezonedate(){
		if ($timezone = date_default_timezone_set('Africa/Johannesburg')) {
			echo "timezones have been set.\n";
				if ($date = date ('Y-m-d')) {
					echo "date has been set.\n";
					echo "date is $date.\n";
					return $date;
					} else {
					echo "failed to set date.\n";
				}//endif for date check
			} else {
			echo "failed to set timezone.\n";
		}//endif for timezone check
	} //end of timezonedate method
} //end of timeset object
?>
