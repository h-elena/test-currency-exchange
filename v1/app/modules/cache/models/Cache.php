<?php

namespace v1\app\modules\cache\models;

use v1\app\classes\Errors;

class Cache
{
    use Errors;

    /**
     * Get record from cache
     *
     * @param string $code
     * @return array
     */
    public function get(string $code)
    {
        /*
         ...
         */
        $data = [
            'RUB' => 1,
            'EUR' => 12,
            'USD' => 9
        ];
        return [];
    }

    /**
     * Add record to cache
     *
     * @param string $code
     * @param array $data
     * @return bool
     */
    public function add(string $code, array $data)
    {
        /*
         ...
         */
        return true;
    }
}