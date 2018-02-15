<?php
include('classes/JsonAnimalParser.php');

//######################################################
$d = new JsonAnimalParser();
$d->parse("http://test.potapenko/misha/get_json.php");
//######################################################


$ch = curl_init("http://test.potapenko/misha/get_json.php");
$arr = array('pass' => 'json');
$arr1 = json_encode($arr);
//curl_setopt($ch, CURLOPT_HEADER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'));

curl_setopt($ch, CURLOPT_POSTFIELDS, $arr1);
//$arr =curl_setopt($ch, CURLOPT_RETURNTRANSFER	, 1); //чтобы предотвратить вывод

// 3. получаем HTML в качестве результата
$output = json_decode(curl_exec($ch), true);
// 4. закрываем соединение e
curl_close($ch);

print_r($output);

/*
include('MySQLConnection.php');
$c = MySQLConnection::getInstance();

$ch = curl_init("http://test.potapenko/misha/get_json.php");

curl_setopt($ch, CURLOPT_POSTFIELDS, "pass=json");
$arr =curl_setopt($ch, CURLOPT_RETURNTRANSFER	, 1);

// 3. получаем HTML в качестве результата
$output = json_decode(curl_exec($ch),true);
// 4. закрываем соединение e
curl_close($ch);

print_r($output);
echo "###".$output['data'][0]['id'];

$type_id = $c->query("SELECT id from types WHERE name = '".($output['data'][0]['type'])."'" );
print_r($type_id);

$size = sizeof($output);
echo $size."size";

for($i=0;$i<$size;$i++) {
    $antype = $c->query("SELECT * FROM types WHERE name = '{$output['data'][$i]['type']}'");
    print_r($antype);
    if(sizeof($antype)<1){
        $c->execute("INSERT INTO `project2`.`types` (`name`) VALUES ('{$output['data'][$i]['type']}')");
    }
    $type_id = $c->query("SELECT id from types WHERE name = '".($output['data'][$i]['type'])."'" );
//    print_r($type_id);
//    echo "ididid".$type_id[0]['id'];

    $idExistCheck = $c->query("SELECT external_id from animals WHERE external_id = '".($output['data'][$i]['id'])."'" );
    if(sizeof($idExistCheck)<1) {
        $insert = "INSERT INTO `project2`.`animals` (`external_id`, `type_id`, `name`, `weight`) VALUES ('" . $output['data'][$i]['id'] . "', '" . $type_id[0]['id'] . "', '" . $output['data'][$i]['name'] . "', '" . $output['data'][$i]['weight'] . "' )";
        $c->execute($insert);
    }
    else{
        $correct = "UPDATE `project2`.`animals` SET `type_id`='{$type_id[0]['id']}', `name`='{$output['data'][$i]['name'] }', `weight`='{$output['data'][$i]['weight']}' WHERE  external_id ={$output['data'][$i]['id']}";
    }
}
*/
echo "hello";



















