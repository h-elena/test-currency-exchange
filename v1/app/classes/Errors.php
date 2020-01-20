<?php

namespace v1\app\classes;

trait Errors
{
    /** @var array $errors */
    public $errors;

    public function getErrors()
    {
        return implode(' ', $this->errors);
    }
}