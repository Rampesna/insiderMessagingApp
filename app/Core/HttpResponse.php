<?php

namespace App\Core;

trait HttpResponse
{
    /**
     * @param string $message
     * @param array|object $data
     * @param integer $statusCode
     * @param boolean $isSuccess
     */
    public function httpResponse(
        string $message,
        int    $statusCode,
        mixed  $data = null,
        bool   $isSuccess = false
    )
    {
        return response()->json([
            'message' => $message,
            'error' => !$isSuccess,
            'code' => $statusCode,
            'response' => $data
        ], $statusCode);
    }
}
