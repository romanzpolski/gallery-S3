<?php

namespace App\Http\Controllers;
use App\AwsImage;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoginController extends Controller
{
    private $log;

    function __construct(){
        $log = new Logger('log');
        $logName = storage_path('/app/logs').'/logs.log';
        $this->log = $log->pushHandler(new StreamHandler($logName, Logger::WARNING));
    }

    public function logIn($request){

        $this->validate($request, [
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        if($user) {
            if(Hash::check($password, $user->password)){
                $apikey = base64_encode(str_random(40));
                User::where('email', $email)->update(['apiKey' => "$apikey"]);
                return response()->json(['msg' => 'Success', 'data'=>array('apiKey' => $apikey, 'loggedIn'=> true)]);
            } else {
                return response()->json(['msg' => 'Wrong password', 'data'=>[]],401);
            }
        } else {
            return response()->json(['msg' => 'No User found with this email', 'data'=>[]],400);
        }
    }
}
