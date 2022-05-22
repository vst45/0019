<?php

namespace App\Helpers;

class Helper
{

    public static function sendResponse($message, $data = [], $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $data
        ];

        return response()->json($response, $code);
    }

    public static function sendError($message, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'errors' => $errorMessages
        ];

        return response()->json($response, $code);
    }
}
