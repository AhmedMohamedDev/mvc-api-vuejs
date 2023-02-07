<?php

namespace App\Core;

class JsonResponse
{
    /*
    * Sends a JSON response to the client.
    * @param array $data the data to be sent in the JSON response.
    * @param int $status the HTTP status code for the response.
    * Default value is 200 (OK).
    */
    public static function send($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
}
