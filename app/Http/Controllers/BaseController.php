<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ApiCatchError;
class BaseController extends Controller
{
    
    public function sendResponse($result, $message , $code=200){
        $response = [
            'success' => true,
            'data'    => $result,
        ];
        
        if(!empty($message)){
            $response['message'] =$message;
        }
        
        return response()->json($response, $code);
    }

    public function sendError($error)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
        
        return response()->json($response, 400);
    }
}
