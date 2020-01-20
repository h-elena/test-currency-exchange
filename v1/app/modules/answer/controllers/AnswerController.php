<?php

namespace v1\app\modules\answer\controllers;

use v1\app\modules\answer\models\Answer;

class AnswerController
{
    public function getJson($code, $message = '', $data = [])
    {
        return (new Answer())->createJsonAnswer($code, $message, $data);
    }
}