<?php
require_once dirname(__FILE__).'/../Modal/mModal.php';
header('Access-Control-Allow-Origin: *');
$objB = new mModal();

$dataAlmacen = $objB->getAlmacen();

// var_dump($dataAlmacen['datosAlmacen']);
