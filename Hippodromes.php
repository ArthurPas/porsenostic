<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'Database.php';
include_once 'RacesInfos.php';

$jsonArray = array();

$database = new Database();
$db = $database->getConnection();
$RaceInfos = new RacesInfos($db);
$Hippodromes = $RaceInfos->getAllHippodrome()->fetchAll();
$json = json_encode($Hippodromes);
echo $json;