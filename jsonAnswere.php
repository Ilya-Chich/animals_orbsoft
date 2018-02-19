<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

$data = $_SERVER['REQUEST_METHOD'];//ПРОВЕРИТЬ ПОСТ ИЛИ НЕТ

if ($data != "POST") {
//    header('HTTP/1.1 405 ');
    http_response_code(405);
    die();
}

$arr1 = json_decode(trim(file_get_contents("php://input")),true);


try {
    $dbh = new PDO('mysql:dbname=project2; host=127.0.0.1', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die($e->getMessage());
}

// добавить заголовок к ответу, что это джонс
header('Content-Type: application/json');

$select1 = "SELECT * FROM animals1";

if(isset($arr1['search']))
    $select1.= " WHERE name LIKE ?";


$sth = $dbh->prepare($select1);
$sth->execute(array( "%{$arr1['search']}%"));
$array = $sth->fetchAll(PDO::FETCH_ASSOC);
$str = json_encode($array, true);

echo $str;
