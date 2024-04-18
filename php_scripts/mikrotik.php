<?php
$ip = "10.4.0.1";
$ext1 = "backup";
$user = "jennyadmin";
$pass = "#jennyADMIN123";
$script = "newfile.rsc";
$normal = "newfile.backup";
$localscript = "/home/phpbackup/$ip.rsc";
$localnormal = "/home/phpbackup/$ip.backup";
$sshcon = ssh2_connect($ip, 2222);
ssh2_auth_password($sshcon, $user, $pass);


ssh2_exec($sshcon, 'system backup save name=newfile');
ssh2_exec($sshcon, 'export file=newfile');
sleep (5);
//$ftpcon = ftp_connect($ip, 22000);
//$ftpauth = ftp_login($ftpcon, $user, $pass);
//$ftpget = ftp_get ($ftpcon, '/home/phpbackup/10.4.0.1.rsc', '10.4.0.1.rsc', FTP_BINARY);
//file_get_contents('ssh2.sftp://sshconn/newfile.rsc');
ssh2_scp_recv($sshcon, "/$script" , "$localscript" );
ssh2_scp_recv($sshcon, "/$normal" , "$localnormal" );
ssh2_exec($sshcon, 'exit');

//:echo "start\n";
//set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
//include('Net/SFTP.php');
//$sftp = new Net_SFTP($ip, 2222);
//$sftp->login($user, $pass);
//$sftp->get('newfile.backup','/home');
?>
