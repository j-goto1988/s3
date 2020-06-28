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

$path = '/var/www/html/hoge.txt';
try {
	$ret = $sdk->putObject([
		'Bucket' => 'test',
		'Key' => 'hoge_put.txt',
		'SourceFile' => $path,
		'ContentType' => mime_content_type($path)
	]);
	echo "<pre>";
	print_r($ret);
	echo "</pre>";
} catch (S3Exception $e) {
	echo $e->getMessage();
}