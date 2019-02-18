<?php
// Bucket Name
$bucket="1book.in";
if (!class_exists('S3'))require_once('s3.php');
			
//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJM3LGVSYXNNK3MKA');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
		
//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

?>