<?php
include('Net/SFTP.php');

$sftp = new Net_SFTP('10.4.0.1:2222');
if (!$sftp->login('jennyadmin', '#jennyADMIN123')) {
    exit('Login Failed');
}

// outputs the contents of filename.remote to the screen
echo $sftp->get('newfile.backup');
// copies filename.remote to filename.local from the SFTP server
$sftp->get('newfile.backup', '/home/newfile.backup');
?>
