<?php
include('classes/XmlAnimalParser.php');


$d = new XmlAnimalParser();
$d->parse("http://test.potapenko/misha/get_xml.php");

//
////// 3. получаем HTML в качестве результата
////$p = xml_parser_create();
////
////$arr =xml_parse_into_struct($p,curl_exec($ch),$vals, $index);
////xml_parser_free($p);
////
//////print_r($vals);
////// 4. закрываем соединение
////curl_close($ch);
////
//////print_r($arr);
//
//curl_setopt($ch, CURLOPT_POSTFIELDS, "pass=xml");
//$arr = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//// 3. получаем HTML в качестве результата
//
//$arr = curl_exec($ch);
//
//
//// 4. закрываем соединение
//curl_close($ch);
//
//$xmlstr1 = (string)($arr);
//echo $xmlstr1;
//
//$response = new SimpleXMLElement($xmlstr1);
//
//foreach ($response->animals->animal as $animal) {
//    echo $animal->name."\n";
//    echo $animal->id."\n";
//    echo $animal->type."\n";
//}

//echo($arr);
//$p = xml_parser_create();
//
//xml_parser_set_option($p, XML_OPTION_CASE_FOLDING, 0);
//xml_parser_set_option($p, XML_OPTION_SKIP_WHITE, 1);
//$arr =xml_parse_into_struct($p,$arr,$vals,$indexes);
//xml_parser_free($p);
//
//print_r($vals);
//$jsonstyle = array();
//$j=0;
//for($i = 0; $i < sizeof($vals); $i++)
//{
//    if($vals[$i]['tag']=='animal' && $vals[$i]['type']=='open'){
//        $i++;
//        $jsonstyle[$j][0] =  $vals[$i]['value'];
//        $i++;
//
//        $jsonstyle[$j][1] =  $vals[$i]['value'];
//        $i++;
//
//        $jsonstyle[$j][2] =  $vals[$i]['value'];
//        $i++;
//
//        $jsonstyle[$j][3] =  $vals[$i]['value'];
//        $i++;
//        $j++;
//    }
//}
//
//echo "\n########\n";
//$output = $jsonstyle;
//print_r($output);
//
//
//
//
//$size = sizeof($output);
//echo $size."size";
//
//for($i=0;$i<$size;$i++) {
//    $antype = $c->query("SELECT * FROM types WHERE name = '{$output[$i][1]}'");
//    print_r($antype);
//    if(sizeof($antype)<1){
//        $c->execute("INSERT INTO `project2`.`types` (`name`) VALUES ('{$output[$i][1]}')");
//    }
//    $type_id = $c->query("SELECT id from types WHERE name = '".($output[$i][1])."'" );
////    print_r($type_id);
////    echo "ididid".$type_id[0]['id'];
//
//    $idExistCheck = $c->query("SELECT external_id from animals WHERE external_id = '".($output[$i][0])."'" );
//    if(sizeof($idExistCheck)<1) {
//        $insert = "INSERT INTO `project2`.`animals` (`external_id`, `type_id`, `name`, `weight`) VALUES ('" . $output[$i][0] . "', '" . $type_id[0]['id'] . "', '" . $output[$i][2] . "', '" . $output[$i][3] . "' )";
//        $c->execute($insert);
//    }
//    else{
//        $correct = "UPDATE `project2`.`animals` SET `type_id`='{$type_id[0]['id']}', `name`='{$output[$i][2] }', `weight`='{$output[$i][3]}' WHERE  external_id ={$output[$i][0]}";
//    }
//}










































































