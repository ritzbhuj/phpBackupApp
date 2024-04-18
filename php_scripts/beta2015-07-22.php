#!/usr/bin/php
<?php
include ('/home/phpbackup/php_objects/class_timeset.php');
include ('/home/phpbackup/php_objects/class_fs.php');
include ('/home/phpbackup/php_objects/class_log.php');
include ('/home/phpbackup/php_objects/class_backup.php');
include ('/home/phpbackup/php_objects/class_procedure.php');
include ('/home/phpbackup/php_objects/class_map.php');
include ('/home/phpbackup/php_objects/class_logcheck.php');
$newinstance = new procedure();
$newinstance->totalrec();
?>
