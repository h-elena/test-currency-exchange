<?php

namespace v1\app\classes;


class HttpRequest
{
    use Errors;

    /**
     * Get record from db
     *
     * @return array
     */
    public function findCourse()
    {
        /*
         ...
         */
        $courses = [
            'RUB' => 1,
            'EUR' => 12,
            'USD' => 9
        ];

        return $courses;
    }
}