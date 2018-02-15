<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 12.02.2018
 * Time: 14:41
 */
include('AnimalParser.php');

class JsonAnimalParser extends AnimalParser
{

    public function parse($url)
    {
        // TODO: Implement parse() method.
        $ch = curl_init($url);

    //        {"pass":"json"}
    //        content-type//
    //
    //        $messege = json_encode()\
        $arr = array('pass' => 'json');
        $arr1 = json_encode($arr);
//curl_setopt($ch, CURLOPT_HEADER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'));

        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr1);
        $arr = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // 3. получаем HTML в качестве результата
        $output = json_decode(curl_exec($ch), true);
        // 4. закрываем соединение e
        curl_close($ch);

        for($i = 0;$i<sizeof($output);$i++){
            $this->saveAnimal($output['data'][$i]['id'],$output['data'][$i]['name'],$output['data'][$i]['type'],$output['data'][$i]['weight']);
        }
    }
}







