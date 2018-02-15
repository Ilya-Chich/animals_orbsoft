<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 12.02.2018
 * Time: 14:35
 */
include('MySQLConnection.php');

abstract class AnimalParser
{
    public abstract function parse($url);

    public function saveAnimal($externalId, $name, $type, $weight)
    {
        // mysql last_insert_id

        $c = MySQLConnection::getInstance();
        $antype = $c->query("SELECT * FROM types WHERE name = '{$c->escape($type)}'");
        if (sizeof($antype) < 1) {
            $c->execute("INSERT INTO `project2`.`types` (`name`) VALUES ('{$c->escape($type)}')");
            $insertResult = $c->query("SELECT LAST_INSERT_ID() as id");
            $typeId = $insertResult[0]['id'];
        } else {
            $typeId = $antype[0]['id'];
        }

        $idExistCheck = $c->query("SELECT external_id from animals WHERE external_id = '{$c->escape($externalId)}'");

        if (sizeof($idExistCheck) < 1) {
            $insert = "INSERT INTO `project2`.`animals` (`external_id`, `type_id`, `name`, `weight`) VALUES ('{$c->escape($externalId)}', '{$c->escape($typeId)}', '{$c->escape($name)}', '{$c->escape($weight)}' )";
            $c->execute($insert);
        } else {

            $correct = "UPDATE `project2`.`animals` SET `type_id`='{$c->escape($typeId)}', `name`='{$c->escape($name)}', `weight`='{$c->escape($weight)}' WHERE  external_id ={$c->escape($externalId)}";
        }
    }
}