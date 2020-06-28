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
	$ret = $sdk->listObjects(['Bucket' => 'test', 'Prefix' => 'tmp']);
	
	$keys = [];
	if (isset($ret['Contents'])) {
		foreach ($ret['Contents'] as $val) {
			$keys[] = $val['Key'];
		}
	}

	$ret = $sdk->deleteObjects(array(
		'Bucket'  => 'test',
		'Delete' => [
			'Objects' => array_map(function ($key) {
				return ['Key' => $key];
			}, $keys)
		]
	));
	echo "<pre>";
	print_r($ret);
	echo "</pre>";
} catch (S3Exception $e) {
	echo $e->getMessage();
}