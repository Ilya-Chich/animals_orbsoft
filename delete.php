<?php
include('MySQLConnection.php');

$c = MySQLConnection::getInstance();

     $id = (string)$_POST['id'];


$delete = "DELETE FROM `project2`.`animals` WHERE  `id`=" . $id;
$c->execute($delete);

header('Location: index.php');  // перенаправление на нужную страницу
exit();
?>
