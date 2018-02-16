<?php


$id = isset($_GET['id'])? $_GET['id'] : 3;

//self::$_instance = new self("127.0.0.1", "root", "", "project2");

try {
    $dbh = new PDO('mysql:dbname=project2; host=127.0.0.1', 'root', '');
} catch (PDOException $e) {
    die($e->getMessage());
}

$select1 = "SELECT * FROM (SELECT an.id , an.name ,  fo.name as \"food\" ,foan.quantity_per_day , fo.price , (foan.quantity_per_day * fo.price) as price_per_day FROM food_animals foan
            JOIN food fo ON foan.food_id = fo.id 
            JOIN animals an ON an.id = foan.animal_id) abc
				 WHERE id = ?";

$select2 = "SELECT * FROM (SELECT id , name , SUM(price_per_day) as sum FROM
            (SELECT an.id , an.name ,  (foan.quantity_per_day * fo.price) as price_per_day FROM food_animals foan
            JOIN food fo ON foan.food_id = fo.id 
            JOIN animals an ON an.id = foan.animal_id) as price
            GROUP BY name) abs
            WHERE id = ?";

$sth = $dbh->prepare($select1);
$sth->execute(array((string)$id));
$array = $sth->fetchAll(PDO::FETCH_ASSOC);
//print_r($array);

//echo  "\n\n\n\n\n\n\n\n".$array[0]['name'];


echo "<html><head></head><body><p> <b>" . (string)$array[0]['name'] . "</p></b></body></html>";
echo '<table border="1">';
echo '<thead>';
echo '<tr>';
echo '<th>food</th>';
echo '<th>quantity_per_day</th>';
echo '<th>price</th>';
echo '<th>price_per_day</th>';
echo '</tr>';
echo '</head>';
echo '<body>';
$size = sizeof($array);
for ($i = 0; $i < $size; $i++) {
    echo '<tr>';
    echo "<td>{$array[$i]['food']}</td>";
    echo "<td>{$array[$i]['quantity_per_day']}</td>";
    echo "<td>{$array[$i]['price']}</td>";
    echo "<td>{$array[$i]['price_per_day']}</td>";

//    echo "<td><button type='submit' ><a href='delete.php?id=".$data[$i]['id']."'> delete </a></button></td>";
    echo '</tr>';
}

$sth2 = $dbh->prepare($select2);
$sth2->execute(array((string)$id));
$array1 = $sth2->fetch(PDO::FETCH_ASSOC);
//print_r($array1);

echo '<table border="1">';
echo '<thead>';
echo '<tr>';
echo '<th>sum_price</th>';
echo "<th>".$array1['sum']."</th>";
echo '</tr>';
echo '</head>';
echo '<body>';