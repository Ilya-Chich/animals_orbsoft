<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 12.02.2018
 * Time: 14:42
 */
include('AnimalParser.php');

class XmlAnimalParser extends AnimalParser
{

    public function parse($url)
    {
        // TODO: Implement parse() method.
        $ch = curl_init($url);



        curl_setopt($ch, CURLOPT_POSTFIELDS, "pass=xml");
        $arr = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        $arr = curl_exec($ch);


        curl_close($ch);

        $xmlstr1 = (string)($arr);
        echo $xmlstr1;

        $response = new SimpleXMLElement($xmlstr1);

        foreach ($response->animals->animal as $animal) {
            $this->saveAnimal($animal->id,$animal->name,$animal->type,$animal->weight);
        }
    }
}