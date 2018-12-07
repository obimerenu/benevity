<?php

// move to public/index.php for production
require 'vendor/autoload.php';

$app = (new \Exempt\benevsAPI\App())->get();
$app->run();
