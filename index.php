<?php
include('MySQLConnection.php');
$c = MySQLConnection::getInstance();
//MySQLConnection("127.0.0.1", "root", "","project2");
?>
<html>
<head>
    <title>
        animals
    </title>

</head>
<body>
<span>
    <form action="" method="get">
        <select name="type_id"><option value=""> Выберите тип животного  </option>    <!-- выпадающий список -->
            <?php
            $select1 = "SELECT name , id FROM types ORDER BY name";
            $data = $c->query($select1);
            for ($i = 0; $i < count($data); $i++) {
                echo "<option value=\"{$data[$i]['id']}\" " . ((isset($_GET['type_id']) && $_GET['type_id'] == $data[$i]['id']) ? "selected" : "") . ">" . htmlentities($data[$i]['name']) . '</option>';
            }
            ?>


        </select>

        <!-- поле поиска-->

         <input name="name" placeholder="Искать здесь..." type="search"
                value="<?= isset($_GET['name']) ? $_GET['name'] : "" ?>">
         <button type="submit">Поиск</button>
   </form>

</span>

<?php
$filters = array();
if (isset($_GET['new_type_id']) && strlen((string)($_GET['new_type_id'])) > 0 && isset($_GET['new_name']) && isset($_GET['new_weight']) && isset($_GET['new_birth_day'])) {
    if (strlen((string)($_GET['new_name'])) > 0 && strlen((string)($_GET['new_weight'])) > 0 && strlen((string)($_GET['new_birth_day'])) > 0) {
        $c->execute(("INSERT INTO `project2`.`animals` (`type_id`, `name`, `weight`, `birth_date`) VALUES ('" . $c->escape((string)$_GET['new_type_id']) . "', '" . $c->escape((string)$_GET['new_name']) . "', '" . (string)$_GET['new_weight'] . "', '" . (string)$_GET['new_birth_day'] . "' )"));
        //echo $insert;
        //mysqli_query($link,$insert);
    }
}


if (isset($_GET['name']) && strlen((string)($_GET['name'])) > 0) { //поле поиска
    $str = $c->escape($_GET['name']);
    $filtders[] = " an.name LIKE '%{$str}%' ";
}

if (isset($_GET['type_id']) && strlen((string)($_GET['type_id'])) > 0) {  //выпадающий список
    $str1 = $c->escape($_GET['type_id']);
    $filters[] = " ty.id = {$str1} ";
}

$selectcode = " SELECT an.id, ty.name as type, an.name, an.weight, an.birth_date  FROM animals an LEFT JOIN types ty on an.type_id = ty.id ";

if (count($filters) > 0) {
    $selectcode .= " WHERE " . implode(' AND ', $filters);
}

//$podres = $c-> query( $selectcode);

echo '<table border="1">';
echo '<thead>';
echo '<tr>';
echo '<th>id</th>';
echo '<th>type</th>';
echo '<th>name</th>';
echo '<th>weight</th>';
echo '<th>birth_date</th>';
echo '</tr>';
echo '</head>';
echo '<body>';
$data = $c->query($selectcode);
for ($i = 0; $i < count($data); $i++) {
    echo '<tr>';
    echo "<td><a href='correct.php?id=" . htmlentities($data[$i]['id']) . "'   >" . htmlentities($data[$i]['id']) . "</a></td>";
    echo '<td>' . htmlentities($data[$i]['type']) . '</td>';
    echo "<td><a href='animalFood.php?id=" . htmlentities($data[$i]['id']) . "'   >" . htmlentities($data[$i]['name']) . "</a></td>";
    echo '<td>' . htmlentities($data[$i]['weight']) . '</td>';
    echo '<td>' . htmlentities($data[$i]['birth_date']) . '</td>';
//    echo "<td><button type='submit' ><a href='delete.php?id=".$data[$i]['id']."'> delete </a></button></td>";
    echo "<td><form method='post' action='delete.php'><input type='hidden' name='id'  value='" . $data[$i]['id'] . "' ></input><input type='submit' value='delete' ></input></form></td>";
    echo '</tr>';
}

?>
<button><a href="new_animal.php">new animal</a></button>

<html/>
