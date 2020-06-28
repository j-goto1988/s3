<?php
require_once 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$sdk = new Aws\S3\S3Client([
	'region' => 'ap-northeast-1',
	'version' => 'latest',
	'credentials' => [
		'key'=>'',
		'secret'=>''
	]
]);

try {
	$ret = $sdk->getObject([
		'Bucket' => 'test',
		'Key' => 'hoge.txt'
	]);
	header("Content-Type: {$ret['ContentType']}");
	echo $ret['Body'];
} catch (S3Exception $e) {
	echo $e->getMessage();
}