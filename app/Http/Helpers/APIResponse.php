<?php 

namespace App\Http\Helpers;

class APIResponse {
    
    /**
     * Make success response
     */
    public static function success($data = [], $statusCode = null)
    {
        return response([
            'success' => true,
            ...$data,
        ], $statusCode ?? 200);
    }


    /**
     * Make error response
     */
    public static function error($message, $description = '', $statusCode)
    {
        return response([
            'succcess' => false,
            'message' => $message,
            'description' => $description,
        ], $statusCode);
    }
}