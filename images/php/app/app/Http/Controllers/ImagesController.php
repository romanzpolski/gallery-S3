<?php

namespace App\Http\Controllers;
use App\AwsImage;
use App\Image;
use Illuminate\Http\Request;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ImagesController extends Controller
{
    private $log;

    function __construct(){
        $log = new Logger('log');
        $logName = storage_path('/app/logs').'/logs.log';
        $this->log = $log->pushHandler(new StreamHandler($logName, Logger::WARNING));
    }

    public function downloadImage($id){
        $img = Image::find($id);
        $img->downloads = $img->downloads+1;
        $img->save();
        return response()->json(array("msg"=>"", "data"=>$img->imageDownloadUrl), 200);
    }

    public function getData($id) {
        $img = Image::find($id);
        $res = array(
            "downloads" => $img->downloads,
            "views"=> $img->views
        );
        return response()->json(array("msg"=>"", "data"=>$res), 200);
    }

    public function getImages($page=0){
        $offset = $page * 9;
        $res = Image::orderBy('created_at', 'DESC')->take(9)->skip($offset)->get();
        $total = Image::count();
        $images = array();
        foreach($res as $r){
            $images[]= array(
                'id'=> $r['id'],
                'name'=> $r['imageName'],
                'path'=> $r['imagePath'],
                'downloads'=> $r['downloads'],
                'views'=> $r['views']
            );
        }
        return response()->json(array("msg"=>"", "data"=>$images, "total"=> $total), 200);
    }

    public function viewImage($id){
        $image = Image::where('id', $id)->firstOrFail();
        $image->views = $image->views + 1;
        $image->save();
        return response()->json(array("msg"=>"", "data"=>$image), 200);
    }

    public function getAwsImages(){
        $client = new AwsImage();
        $res = $client->getImages();
        return ['msg'=>'All went fine', 'images' => $res ];
    }

    public function uploadImage(Request $request){

        $name = $request->input('name');

//        $this->log->warning($name);

        $this->validate($request, [
            'image' => 'required|dimensions:max_width=1000,max_width=1000|mimes:jpeg,png'
        ]);

        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $imgName = time() . '.' . $ext;
        //$this->saveToDisk($image, $imgName);
        $imgDownloadUrl =  $this->saveToS3($image, $imgName);
        $this->saveToDb($name, $imgName, $imgDownloadUrl);

        return response()->json(array("image"=>"Image uploaded ".$imgName), 201);
    }

    private function saveToDb($name, $imgName, $imgDownloadUrl) {
        $img = new Image();
        $img->imageName = $name;
        $img->imagePath = "https://s3-eu-west-1.amazonaws.com/gallery-project/".$imgName;
        $img->imageDownloadUrl = $imgDownloadUrl;
        $img->userId = 1;
        $img->save();
        return $this;
    }

    private function saveToDisk($image, $imgName){
        $destinationPath = storage_path('/app/images');
        $image->move($destinationPath, $imgName);
        return $this;
    }

    private function saveToS3($image, $imgName) {
        $client = new AwsImage();
        $imgDownloadUrl = $client->addImage($image, $imgName);
        return $imgDownloadUrl;
    }
}
