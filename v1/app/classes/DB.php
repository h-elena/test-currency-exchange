<?php

namespace v1\app\classes;


class DB
{
    use Errors;

    /**
     * Get record from db
     *
     * @param string $code
     * @return array
     */
    public function findCourse(string $code)
    {
        /*
         ...
         */
        $courses = [
            'RUB' => 1,
            'EUR' => 12,
            'USD' => 9
        ];

        return [];
    }

    /**
     * Add record to db
     *
     * @param string $code
     * @param array $data
     * @return bool
     */
    public function addCourse(string $code, array $data)
    {
        /*
         ...
         */
        return true;
    }
}