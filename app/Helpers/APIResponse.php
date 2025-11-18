<?php 

namespace App\Helpers;

class APIResponse {
    
    /**
     * Make success response
     */
    public static function success($data = [], $statusCode = null)
    {
        return response(
            ['success' => true, ...$data],
            $statusCode ?? 200
        );
    }


    /**
     * Make error response
     */
    public static function error($data, $statusCode)
    {
        if (gettype($data) === 'string') {
            return response(
                ['succcess' => false, 'message' => $data],
                $statusCode
            );
        } else {
            return response(
                ['succcess' => false, ...$data],
                $statusCode
            );
        }
        
    }
}