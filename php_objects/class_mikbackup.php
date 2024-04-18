#!/usr/bin/php
<?php
/*
date:2015-07-16
by:ritesh
desc:update map table
*/
$sshconn = ssh2_connect ('10.4.0.34', 2222);
$ipv4add = "10.24.0.5";
$naming = str_replace (".", "-", $ipv4add);
echo "$naming\n";
if ($sshconn) {
echo "Connection successful\n";
}
$auth = ssh2_auth_password ($sshconn, 'jennyadmin', '#jennyADMIN123');
If ($auth) {
echo "Auth success\n";
}

ssh2_exec ($sshconn, "system backup save name=identity.backup");
ssh2_scp_recv ($sshconn, 'identity.backup', 'home/phpbackup');
ssh2_exec ($sshconn, 'exit');
?>