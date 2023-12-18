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

if(count($_GET)>0){
    $topTen = $RaceInfos->getAllStat($_GET)->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($topTen);
}
echo $json;
//if(isset($_GET['hippodrome'])){
//    $topTen = $RaceInfos->getGlobalRankByTypes("H",array("",$_GET['hippodrome'],""))->fetchAll(PDO::FETCH_ASSOC);
//    $json = json_encode($topTen);
//}
//if(isset($_GET['trainer'])){
//    $topTen = $RaceInfos->getGlobalRankByTypes("T",array("","",$_GET['trainer']))->fetchAll(PDO::FETCH_ASSOC);
//    $json = json_encode($topTen);
//}
//if(isset($_GET['driver'])){
//    $topTen = $RaceInfos->getGlobalRankByTypes("D",array($_GET['driver'],"",""))->fetchAll(PDO::FETCH_ASSOC);
//    $json = json_encode($topTen);
//}
//if(isset($_GET['driver'])&&isset($_GET['hippodrome'])){
//    $topTen = $RaceInfos->getGlobalRankByTypes("DH",array($_GET['driver'],$_GET['hippodrome'],""))->fetchAll(PDO::FETCH_ASSOC);
//    $json = json_encode($topTen);
//}
//if(isset($_GET['trainer'])&&isset($_GET['hippodrome'])){
//    $topTen = $RaceInfos->getGlobalRankByTypes("HT",array("",$_GET['hippodrome'],$_GET['trainer']))->fetchAll(PDO::FETCH_ASSOC);
//    $json = json_encode($topTen);
//}
//if(isset($_GET['trainer'])&&isset($_GET['driver'])){
//    $topTen = $RaceInfos->getGlobalRankByTypes("TD",array($_GET['driver'],"",$_GET['trainer']))->fetchAll(PDO::FETCH_ASSOC);
//    $json = json_encode($topTen);
//}
//if(isset($_GET['trainer'])&&isset($_GET['driver'])&&isset($_GET['hippodrome'])){
//    $topTen = $RaceInfos->getGlobalRankByTypes("TDH",array($_GET['driver'],$_GET['hippodrome'],$_GET['trainer']))->fetchAll(PDO::FETCH_ASSOC);
//    $json = json_encode($topTen);
//}