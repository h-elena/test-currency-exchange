<?php

namespace v1\app\modules\answer\models;

use v1\app\classes\Errors;

class Answer
{
    use Errors;

    /**
     * @param int $code
     * @param string $message
     * @param array $data
     * @return false|string
     */
    public function createJsonAnswer(int $code, string $message, array $data): string
    {
        $mas = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];

        return json_encode($mas);
    }
}