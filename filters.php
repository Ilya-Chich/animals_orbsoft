<?php
include('MySQLConnection.php');
$c = MySQLConnection::getInstance();
//MySQLConnection("127.0.0.1", "root", "","project2");
$id = 35;

$select_an = "Select an.* , ty.name as type_name From animals an join types ty on ty.id = an.type_id WHERE an.id = " . $id;
$cur_an = $c->query($select_an);
print_r($cur_an);

?>