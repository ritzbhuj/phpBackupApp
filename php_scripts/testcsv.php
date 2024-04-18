#!/usr/bin/php
<?php
include ('/home/phpbackup/php_objects/class_csvcheck.php');
$filechecks = new csvcheck('/home/phpbackup/dude_csv/Devices.csv');
$filechecks->procedure();
?>
