<?php
namespace App;
require '../vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Credentials\CredentialProvider;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class AwsImage {

    protected $s3;
    private $log;

    function __construct(){

        $log = new Logger('log');
        $logName = storage_path('/app/logs').'/logs.log';
        $this->log = $log->pushHandler(new StreamHandler($logName, Logger::WARNING));

        $opts = [
            'region' => 'eu-west-1',
            'version' => 'latest',
            'credentials' => CredentialProvider::env()
        ];

        $this->s3 = new S3Client($opts);
    }

    function addImage($image, $imgName){
        $img = file_get_contents($image);
        $result = $this->s3->putObject([
            'ACL' => 'public-read',
            'Bucket' => 'gallery-project',
            'Key' => $imgName,
            'Body' => $img
        ]);

        return $result->get('ObjectURL');
    }

    public function getImages(){
        $res = $this->s3->listObjects([
            'Bucket' => 'gallery-project'
        ]);
        $newRes = array();
        foreach($res['Contents'] as $r){
            $newRes[] = $r['Key'];
        }
        return $newRes;
    }

}
