<?php

namespace v1\app\modules\currency\models;

use v1\app\classes\Errors;

class Currency
{
    use Errors;

    const VARIANTS = [
        'RUB' => 'руб.',
        'EUR' => 'евро',
        'USD' => 'доллар США'
    ]; //best set currency in base

    public function getErrors()
    {
        return implode(' ', $this->errors);
    }

    /**
     * Check currency for existence.
     *
     * @param string $name
     * @return bool
     */
    public function checkCurrency(string $name): bool
    {
        if (isset(self::VARIANTS[$name])) {
            return true;
        }

        $this->errors[] = 'The currency ' . $name . ' does not exist.';

        return false;
    }
}