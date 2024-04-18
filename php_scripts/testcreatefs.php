#!/usr/bin/php
<?php
include ('/home/phpbackup/php_objects/class_fs.php');
include ('/home/phpbackup/php_objects/class_timeset.php');
$testcreate = new createfs('testmap');
$testcreate->createpath();
?>
