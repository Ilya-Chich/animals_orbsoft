<?php


$id = $_GET['id'];
echo $id;
$dbh = new PDO('mysql:dbname=db_name;host=localhost', 'логин', 'пароль');

$select1 = "SELECT an.id , an.name ,  fo.name as \"food\" ,foan.quantity_per_day , fo.price , (foan.quantity_per_day * fo.price) as price_per_day FROM food_animals foan
            JOIN food fo ON foan.food_id = fo.id 
            JOIN animals an ON an.id = foan.animal_id";

$select2 = "SELECT id , name , SUM(price_per_day) as sum FROM
            (SELECT an.id , an.name ,  (foan.quantity_per_day * fo.price) as price_per_day FROM food_animals foan
            JOIN food fo ON foan.food_id = fo.id 
            JOIN animals an ON an.id = foan.animal_id) as price
            GROUP BY name";
