<?php
include_once __DIR__ . '/../../../vendor/autoload.php';

use v1\app\modules\currency\controllers\ExchangeController;

$exchange = new ExchangeController();
echo $exchange->get(123, 'RUB', 'EUR');