<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'Database.php';
include_once 'RacesInfos.php';

$database = new Database();
$db = $database->getConnection();
$RaceInfos = new RacesInfos($db);
$Hippodromes = $RaceInfos->getAllTrainer()->fetchAll(PDO::FETCH_COLUMN);
$json = json_encode($Hippodromes);
echo $json;