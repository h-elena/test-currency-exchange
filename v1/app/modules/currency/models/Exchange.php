<?php

namespace v1\app\modules\currency\models;

use v1\app\classes\DB;
use v1\app\classes\Errors;
use v1\app\classes\HttpRequest;
use v1\app\modules\cache\models\Cache;

class Exchange
{
    use Errors;

    /**
     * Get the amount in new currency
     *
     * @param float $amount
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return bool|float
     */
    public function get(float $amount, string $currencyFrom, string $currencyTo)
    {
        if ($amount > 0) {
            $currency = new Currency();
            if (
                $currency->checkCurrency($currencyFrom) &&
                $currency->checkCurrency($currencyTo) &&
                $courseFrom = $this->getCourse($currencyFrom) &&
                    $courseTo = $this->getCourse($currencyTo)
            ) {
                $result = ($amount * $courseFrom) / $courseTo;
                var_dump($result);

                return $result;
            }

            if (!empty($currency->errors)) {
                $this->errors[] = $currency->getErrors();
            }
        } else {
            $this->errors[] = 'The amount must be greater than 0';
        }

        return false;
    }

    /**
     * Get the course for the current currency
     *
     * @param string $currency
     * @return bool|float
     */
    protected function getCourse(string $currency)
    {
        if ($course = $this->getCourseFromCache($currency)) {
            return $course;
        } elseif ($course = $this->getCourseFromDb($currency)) {
            return $course;
        } elseif ($course = $this->getCourseFromHttp($currency)) {
            return $course;
        }

        return false;
    }

    /**
     * Get course from cache
     *
     * @param string $currency
     * @return bool|float
     */
    protected function getCourseFromCache(string $currency)
    {
        $cache = new Cache();
        if ($courses = $cache->get('currency') && !empty($courses[$currency])) {
            return $courses[$currency];
        }

        if (!empty($cache->errors)) {
            $this->errors[] = $cache->getErrors();
        }

        return false;
    }

    /**
     * Get course from db
     *
     * @param string $currency
     * @return bool|float
     */
    protected function getCourseFromDb(string $currency)
    {
        $db = new DB();

        if ($courses = $db->findCourse('currency')) {
            $this->setCourseToCache($courses);

            if (!empty($courses[$currency])) {
                return $courses[$currency];
            }

            if (!empty($db->errors)) {
                $this->errors[] = $db->getErrors();
            }

            $this->errors[] = 'The course for ' . $currency . ' is not found in DB.';
        }

        return false;
    }

    /**
     * Set course to cache
     *
     * @param array $data
     * @return bool
     */
    protected function setCourseToCache(array $data)
    {
        $cache = new Cache();
        if ($cache->add('currency', $data)) {
            return true;
        }

        if (!empty($cache->errors)) {
            $this->errors[] = $cache->getErrors();
        }

        return false;
    }

    /**
     * Set course to db
     *
     * @param string $data
     * @return bool
     */
    protected function setCourseToDb(array $data)
    {
        $db = new DB();
        $db->addCourse('currency', $data);

        if (!empty($db->errors)) {
            $this->errors[] = $db->getErrors();
        }

        return false;
    }

    /**
     * Get course from http request
     *
     * @param string $currency
     * @return bool|float
     */
    protected function getCourseFromHttp(string $currency)
    {
        $request = new HttpRequest();

        if ($courses = $request->findCourse()) {
            $this->setCourseToDb($courses);
            $this->setCourseToCache($courses);

            if (!empty($courses[$currency])) {
                return $courses[$currency];
            }

            if (!empty($courses->errors)) {
                $this->errors[] = $courses->getErrors();
            }

            $this->errors[] = 'The course for ' . $currency . ' is not found in http request.';
        }

        return false;
    }
}