<?php
require_once dirname(__FILE__).'/../Modal/mModal.php';
header('Access-Control-Allow-Origin: *');
$objB = new mModal();
$input = json_decode(file_get_contents('php://input'), true);
$buscar = $objB->busqueda($input['code'],$input['almacen']);

// var_dump($buscar);17SUTAGDA

echo json_encode($buscar);