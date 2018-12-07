<?php

$container = $app->getContainer();

$container['HomeController'] = function ($container) {
  return new \CapitalsObi\benevsAPI\Controller\HomeController();
};

$container['StatementController'] = function () {
    return new \CapitalsObi\benevsAPI\Controller\StatementController();
};

$container['CustomerController'] = function () {
    return new \CapitalsObi\benevsAPI\Controller\CustomerController();
};

$container['AuthController'] = function () {
    return new \CapitalsObi\benevsAPI\Controller\AuthController();
};
