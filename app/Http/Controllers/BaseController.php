<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
   public function sendResponse($result, $message) {
    $response = [
        'success' => true,
        'result' => count($result),
        'data' => $result,
        'message' => $message
    ];

    return response()->json($response, 200);
   }

   public function sendError($error, $errorMessge=[], $code=404) {
    $response = [
        'success' => false,
        'message' => $error,
    ];

    if(!empty($errorMessge)){
        $response['date']  = $errorMessge;
    }

    return response()->json($response, $code);
   }
}
