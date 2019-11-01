<?php
require_once __DIR__ . '/vendor/autoload.php';

require __DIR__. "/app/init.php";

$leaf = new Leaf\Core\Leaf;
$response = new Leaf\Core\Http\Response;
$request = new Leaf\Core\Http\Request;
$errors = new Leaf\Config\Errors;

$errors->hide();

require __DIR__. "/app/routes/routes.php";

$leaf->run();