<?php
include('MySQLConnection.php');
$c = MySQLConnection::getInstance();
//MySQLConnection("127.0.0.1", "root", "","project2");
?>
<html>
<head>
<body>
<title>new animal</title>
<form action="" method="get">
    <select name="new_type_id">
        <option value=""> Выберите тип животного</option>    <!-- выпадающий список -->
        <?php
        $select1 = "SELECT name , id FROM types ORDER BY name";
        $data = $c->query($select1);
        for ($i = 0; $i < count($data); $i++) {
            echo "<option value=\"{$data[$i]['id']}\" " . ((isset($_GET['type_id']) && $_GET['type_id'] == $data[$i]['id']) ? "selected" : "") . ">" . htmlentities($data[$i]['name']) . '</option>';
        }
        ?>


    </select>

    <!-- поле поиска-->

    <input name="new_name" placeholder="имя" type="search"
           value="">
    <input name="new_weight" placeholder="вес" type="search"
           value="">
    <input name="new_birth_day" placeholder="дата рождения" type="date"
           value="">
    <button type="sabmit">Add</button>

</form>
</body>
</head>
</html>
<?php
$filters = array();
if (isset($_GET['new_type_id']) && strlen((string)($_GET['new_type_id'])) > 0 && isset($_GET['new_name']) && isset($_GET['new_weight']) && isset($_GET['new_birth_day'])) {
    if (strlen((string)($_GET['new_name'])) > 0 && strlen((string)($_GET['new_weight'])) > 0 && strlen((string)($_GET['new_birth_day'])) > 0) {
        $c->execute(("INSERT INTO `project2`.`animals` (`type_id`, `name`, `weight`, `birth_date`) VALUES ('" . $c->escape((string)$_GET['new_type_id']) . "', '" . $c->escape((string)$_GET['new_name']) . "', '" . (string)$_GET['new_weight'] . "', '" . (string)$_GET['new_birth_day'] . "' )"));
        //mysqli_query($link,$insert);
        header('Location: index.php');  // перенаправление на нужную страницу
        exit();
    }
}


//$podres = $c-> query( $selectcode);


?>
<html/>
