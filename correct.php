<?php
include('MySQLConnection.php');
$c = MySQLConnection::getInstance();
//MySQLConnection("127.0.0.1", "root", "","project2");
$id = $_GET['id'];
if (isset($_GET['id'])) {
    $id = (string)$_POST['id'];
}
echo $id;
    $select_an = "SELECT  * FROM animals  WHERE id = " . $id;
    $cur_an = $c->getFirst($select_an);

?>

    <html>
    <head>
    <body>
    <title> Correct animal </title>
    <form action="" method="post">
        <select name="new_type_id">

               <!-- выпадающий список -->
            <?php
            $select1 = "SELECT * FROM types ";
            $data = $c->query($select1);
            for ($i = 0; $i < count($data); $i++) {
                echo "<option value=\"{$data[$i]['id']}\" " . ( ($data[$i]['id'] == $cur_an['type_id']) ? "selected" : "") . ">" . htmlentities($data[$i]['name']) . '</option>';
            }
            ?>



        </select>

        <!-- поле поиска-->
        <?php

        echo "<input name='new_name' value =  '" . $cur_an['name'] . "' placeholder='имя' type='search'   >";
        echo "<input name='new_weight' value =  '" . $cur_an['weight'] . "' placeholder='имя' type='search'   >";
        echo "<input name='new_birth_day' value =  '" . $cur_an['birth_date'] . "' placeholder='имя' type='date'   >";
        echo "<input name = 'id' value = '".$id."' type = 'hidden'>";
        ?>

        <button type="submit"> update</button>

    </form>
    </body>
    </head>
    </html>
<?php
if (isset($_POST['new_type_id']) && strlen((string)($_POST['new_type_id'])) > 0 && isset($_POST['new_name']) && isset($_POST['new_weight']) && isset($_POST['new_birth_day'])) {
    if (strlen((string)($_POST['new_name'])) > 0 && strlen((string)($_POST['new_weight'])) > 0 && strlen((string)($_POST['new_birth_day'])) > 0) {
        $c->execute("UPDATE `project2`.`animals` SET `type_id`='{$c->escape((string)$_POST['new_type_id'])}', `name`='{$c->escape((string)$_POST['new_name'])}', `weight`='{$c->escape((string)$_POST['new_weight'])}', `birth_date`=' {$c->escape((string)$_POST['new_birth_day'])}' WHERE  `id`= " . $id);
        //mysqli_query($link,$insert);
        header('Location: index.php');  // перенаправление на нужную страницу
        exit();
    }
}
?>