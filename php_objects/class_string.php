#!/usr/bin/php
<?php
/*
date: 2015-06-28
created by: ritesh
description: procedure to test string comparisons in PHP; to get passwords in terms of IP address
*/
$string1="10.4.0.0/16";
$string2="10.4.0.3";
$test1=explode (".", $string1);
$test2=explode (".", $string2);
$output1=$test1[0].$test1[1];
$output2=$test2[0].$test2[1];
echo "$output1\n";
echo "$output2\n";
if ($output1 == $output2) {
	echo "Strings are same\n";
	} else {
	echo "Strings are different\n";
}
?>