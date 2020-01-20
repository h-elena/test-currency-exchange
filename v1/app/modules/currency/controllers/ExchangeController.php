<?php

namespace v1\app\modules\currency\controllers;

use v1\app\modules\answer\controllers\AnswerController;
use v1\app\modules\currency\models\Exchange;

class ExchangeController
{
    /**
     * @param float $amount
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return string
     */
    public function get(float $amount, string $currencyFrom, string $currencyTo): string
    {
        $exchange = new Exchange();

        if ($result = $exchange->get($amount, $currencyFrom, $currencyTo)) {
            return (new AnswerController())->getJson(200, '', ['result' => $result]);
        }

        return (new AnswerController())->getJson(400, $exchange->getErrors());
    }
}